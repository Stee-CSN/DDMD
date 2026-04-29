<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|string|max:20',
            'dining_type' => 'required|in:eat-in,takeaway',
            'people_count' => 'required|integer|min:1|max:20',
            'reservation_datetime' => 'nullable|date',
            'special_requests' => 'nullable|string',
            'order_items' => 'nullable|array',
            'order_total' => 'nullable|numeric',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';
        
        // Convert order_items to JSON
        if (isset($validated['order_items'])) {
            $validated['order_items'] = json_encode($validated['order_items']);
        }

        $reservation = Reservation::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Reservation created successfully',
            'reservation' => $reservation
        ]);
    }

    public function myReservations()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Decode order_items for each reservation
        foreach ($reservations as $reservation) {
            if ($reservation->order_items) {
                $reservation->order_items = json_decode($reservation->order_items, true);
            }
        }

        return view('my-reservations', compact('reservations'));
    }
}