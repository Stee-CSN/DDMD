<?php

namespace App\Http\Controllers;

use App\Models\SnookerBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'table_type' => 'required|string',
            'people_count' => 'required|integer|min:1|max:10',
        ]);
        
        // Check operating hours (10 AM to 10 PM)
        $hour = intval(substr($request->start_time, 0, 2));
        if ($hour < 10 || $hour >= 22) {
            return back()->with('error', 'Operating hours are from 10:00 AM to 10:00 PM only!');
        }
        
        // Check if table is already booked
        $isAlreadyBooked = SnookerBooking::where('booking_date', $request->booking_date)
            ->where('start_time', $request->start_time)
            ->where('table_type', $request->table_type)
            ->exists();
        
        if ($isAlreadyBooked) {
            return back()->with('error', 'This table is already booked for the selected date and time!');
        }
        
        // Create the booking
        $booking = SnookerBooking::create([
            'user_id' => Auth::id(),
            'customer_name' => Auth::user()->name,
            'customer_email' => Auth::user()->email,
            'customer_phone' => Auth::user()->phone ?? '',
            'people_count' => $request->people_count,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->start_time,
            'start_time' => $request->start_time,
            'table_type' => $request->table_type,
            'status' => 'pending',
            'total_amount' => 100,
        ]);
        
        return redirect()->route('snooker.index')->with('success', 'Table booked successfully! Pay Nu. 100 at the counter.');
    }
    
    public function destroy($id)
    {
        $booking = SnookerBooking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();
        
        $booking->delete();
        
        return redirect()->route('snooker.index')->with('success', 'Booking cancelled successfully!');
    }
}