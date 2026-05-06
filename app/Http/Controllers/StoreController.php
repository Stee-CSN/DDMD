<?php
// app/Http/Controllers/StoreController.php

namespace App\Http\Controllers;

use App\Models\StoreOrder;
use App\Models\StoreProduct;
use App\Models\StoreFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreController extends Controller
{
    public function index()
    {
        $products = StoreProduct::where('is_active', true)->get();
        $feedbacks = StoreFeedback::with('user')->where('is_approved', true)->latest()->limit(10)->get();
        $averageRating = StoreFeedback::avg('rating') ?? 0;
        
        return view('shop', compact('products', 'feedbacks', 'averageRating'));
    }
    
    public function getProducts(Request $request)
    {
        $query = StoreProduct::where('is_active', true);
        
        if ($request->category && $request->category != 'all') {
            $query->where('category', $request->category);
        }
        
        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } else {
            $query->orderBy('rating', 'desc');
        }
        
        $products = $query->get();
        return response()->json(['products' => $products]);
    }
    
    public function placeOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|json',
            'total_amount' => 'required|numeric',
            'delivery_address' => 'required|string|max:500'
        ]);
        
        $items = json_decode($request->items, true);
        $orderNumber = 'ORD-' . strtoupper(Str::random(8)) . '-' . time();
        
        $order = StoreOrder::create([
            'user_id' => Auth::id(),
            'order_number' => $orderNumber,
            'items' => $items,
            'total_amount' => $request->total_amount,
            'delivery_address' => $request->delivery_address,
            'status' => 'pending',
            'order_time' => now(),
            'cancellation_deadline' => now()->addHour()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order' => $order
        ]);
    }
    
    public function cancelOrder($id)
    {
        $order = StoreOrder::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        
        if (now() > $order->cancellation_deadline) {
            return response()->json(['success' => false, 'message' => 'Order can only be cancelled within 1 hour'], 400);
        }
        
        if ($order->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Order cannot be cancelled'], 400);
        }
        
        $order->update(['status' => 'cancelled']);
        
        return response()->json(['success' => true, 'message' => 'Order cancelled successfully']);
    }
    
    public function getMyOrders()
    {
        $orders = StoreOrder::where('user_id', Auth::id())->latest()->get();
        return response()->json(['orders' => $orders]);
    }
    
    public function submitFeedback(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:1000'
        ]);
        
        $feedback = StoreFeedback::create([
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review' => $request->feedback,
            'is_approved' => true
        ]);
        
        return response()->json(['success' => true, 'message' => 'Thank you for your feedback!']);
    }
}