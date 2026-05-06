<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RestaurantController extends Controller
{
    /**
     * Show the restaurant homepage
     */
    public function index()
    {
        $reservations = [];
        if (Auth::check()) {
            $reservations = Reservation::where('user_id', Auth::id())
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('restaurant', compact('reservations'));
    }

    /**
     * Store a new reservation
     */
    public function store(Request $request)
    {
        // Debug logging
        Log::info('Reservation store attempt', [
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);

        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'guests' => 'required|integer|min:1|max:20',
            'reservation_date' => 'required|date',
            'reservation_time' => 'required',
            'special_requests' => 'nullable|string|max:1000',
        ]);

        try {
            // Create the reservation using your exact table columns
            $reservation = Reservation::create([
                'user_id' => Auth::id(),
                'name' => $request->name,
                'phone' => $request->phone,
                'guests' => $request->guests,
                'reservation_date' => $request->reservation_date,
                'reservation_time' => $request->reservation_time,
                'special_requests' => $request->special_requests,
                'status' => 'confirmed',
            ]);

            Log::info('Reservation created successfully', ['id' => $reservation->id]);

            // Check if it's an AJAX request from the restaurant page
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reservation #' . $reservation->id . ' created successfully!',
                    'reservation' => $reservation
                ]);
            }

            return redirect()->route('my-reservations')
                ->with('success', 'Reservation #' . $reservation->id . ' created successfully!');

        } catch (\Exception $e) {
            Log::error('Reservation creation failed: ' . $e->getMessage());
            
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to create reservation: ' . $e->getMessage()
                ], 500);
            }
            
            return back()
                ->withInput()
                ->with('error', 'Failed to create reservation. Please try again.');
        }
    }

    /**
     * Show user's reservations
     */
    public function myReservations()
    {
        // Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to view your reservations.');
        }

        $reservations = Reservation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('my-reservations', compact('reservations'));
    }

    /**
     * Cancel a reservation
     */
    public function cancel($id)
    {
        try {
            $reservation = Reservation::findOrFail($id);
            
            // Check if user owns this reservation
            if ($reservation->user_id !== Auth::id()) {
                if (request()->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
                }
                abort(403, 'Unauthorized');
            }

            // Check if already cancelled
            if ($reservation->status === 'cancelled') {
                if (request()->ajax()) {
                    return response()->json(['success' => false, 'message' => 'Reservation already cancelled'], 400);
                }
                return redirect()->route('my-reservations')
                    ->with('error', 'Reservation already cancelled.');
            }

            $reservation->update(['status' => 'cancelled']);

            if (request()->ajax()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Reservation #' . $reservation->id . ' cancelled successfully!'
                ]);
            }

            return redirect()->route('my-reservations')
                ->with('success', 'Reservation #' . $reservation->id . ' cancelled successfully.');

        } catch (\Exception $e) {
            Log::error('Reservation cancellation failed: ' . $e->getMessage());
            
            if (request()->ajax()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Failed to cancel reservation.'
                ], 500);
            }
            
            return redirect()->route('my-reservations')
                ->with('error', 'Failed to cancel reservation. Please try again.');
        }
    }
}