<?php

namespace App\Http\Controllers;

use App\Models\SnookerBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SnookerController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $bookings = SnookerBooking::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $bookings = collect();
        }
        
        return view('snooker', compact('bookings'));
    }
    
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'start_time' => 'required',
            'duration_hours' => 'required|integer|min:1|max:4',
            'table_type' => 'required|string|in:standard,premium,vip',
            'people_count' => 'required|integer|min:1|max:10',
            'special_requests' => 'nullable|string|max:500',
        ]);
        
        // Check operating hours (10 AM to 10 PM)
        $hour = intval(substr($request->start_time, 0, 2));
        if ($hour < 10 || $hour >= 22) {
            return back()->with('error', 'Operating hours are from 10:00 AM to 10:00 PM only!');
        }
        
        // Calculate end time based on duration
        $startTime = Carbon::parse($request->booking_date . ' ' . $request->start_time);
        $endTime = (clone $startTime)->addHours((int)$request->duration_hours);
        
        // Check if table is already booked for the selected time slot
        $isAlreadyBooked = SnookerBooking::where('booking_date', $request->booking_date)
            ->where('table_type', $request->table_type)
            ->where(function($query) use ($startTime, $endTime) {
                $query->whereBetween('start_time', [$startTime, $endTime])
                      ->orWhereBetween('end_time', [$startTime, $endTime]);
            })
            ->whereNotIn('status', ['cancelled', 'completed'])
            ->exists();
        
        if ($isAlreadyBooked) {
            return back()->with('error', 'This ' . ucfirst($request->table_type) . ' table is already booked for the selected date and time!');
        }
        
        // Calculate total amount (flat rate per board regardless of hours)
        $totalAmount = $this->calculatePrice($request->table_type);
        
        // Create the booking with all required fields
        $booking = SnookerBooking::create([
            'user_id' => Auth::id(),
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_phone' => Auth::user()->phone ?? 'N/A',
            'people_count' => $request->people_count,
            'booking_date' => $request->booking_date,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'booking_time' => $startTime,
            'duration_hours' => (int)$request->duration_hours,
            'table_type' => $request->table_type,
            'special_requests' => $request->special_requests,
            'status' => 'confirmed',
            'total_amount' => $totalAmount,
        ]);
        
        return redirect()->route('snooker.index')->with('success', 
            'Table booked successfully! ' . ucfirst($request->table_type) . ' table for ' . $request->duration_hours . ' hour(s). Total: Nu. ' . number_format($totalAmount) . '. Please pay at the counter.'
        );
    }
    
    public function destroy($id)
    {
        try {
            $booking = SnookerBooking::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
            
            // Only allow cancellation if booking is not already cancelled or completed
            if ($booking->status === 'cancelled') {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking already cancelled.'
                ], 400);
            }
            
            if ($booking->status === 'completed') {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot cancel a completed booking.'
                ], 400);
            }
            
            // Update the booking status to cancelled
            $booking->update(['status' => 'cancelled']);
            
            // You can also add a cancelled_at timestamp if you have that column
            // $booking->update(['status' => 'cancelled', 'cancelled_at' => now()]);
            
            return response()->json([
                'success' => true,
                'message' => 'Booking cancelled successfully!'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to cancel booking. Please try again.'
            ], 500);
        }
    }
    
    /**
     * Calculate price based on table type only (flat rate per board)
     * Price does not depend on duration hours
     * 
     * @param string $tableType
     * @return int
     */
    private function calculatePrice($tableType)
    {
        // Flat rate per board regardless of hours
        $rates = [
            'standard' => 100,  // Flat rate per board
            'premium' => 100,   // Flat rate per board
            'vip' => 100        // Flat rate per board
        ];
        
        return $rates[$tableType] ?? 100;
    }
}