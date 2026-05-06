<?php
// app/Http/Controllers/Admin/AdminDashboardController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\SnookerBooking;
use App\Models\StoreOrder;
use App\Models\User;
use App\Models\StoreProduct;
use App\Models\StoreFeedback;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::user();
            if (!$user || ($user->role !== 'admin' && $user->role !== 'super_admin' && $user->is_admin != 1)) {
                abort(403, 'Unauthorized access. Admin privileges required.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $stats = [
            'total_store_orders' => StoreOrder::count(),
            'total_reservations' => Reservation::count(),
            'total_snooker_bookings' => SnookerBooking::count(),
            'total_users' => User::count(),
        ];
        
        $todayReservations = Reservation::whereDate('reservation_datetime', today())->get();
        $pendingStoreOrders = StoreOrder::where('status', 'pending')->get();
        $recentFeedbacks = StoreFeedback::with('user')->latest()->limit(5)->get();
        
        $storeOrders = StoreOrder::with('user')->latest()->get();
        $products = StoreProduct::all();
        $allReservations = Reservation::latest()->get();
        $allSnookerBookings = SnookerBooking::latest()->get();
        $allUsers = User::all();
        $allFeedbacks = StoreFeedback::with('user')->latest()->get();
        $branches = Branch::all();
        
        return view('admin.dashboard', compact(
            'stats', 'todayReservations', 'pendingStoreOrders', 'recentFeedbacks',
            'storeOrders', 'products', 'allReservations', 'allSnookerBookings',
            'allUsers', 'allFeedbacks', 'branches'
        ));
    }
    
    // Stats API
    public function getStats()
    {
        return response()->json([
            'store_orders' => StoreOrder::count(),
            'reservations' => Reservation::count(),
            'snooker_bookings' => SnookerBooking::count(),
            'users' => User::count(),
        ]);
    }
    
    // Store Orders
    public function getStoreOrders()
    {
        $orders = StoreOrder::with('user')->latest()->get();
        return response()->json(['orders' => $orders]);
    }
    
    public function getStoreOrderDetails($id)
    {
        $order = StoreOrder::with('user')->findOrFail($id);
        return response()->json(['order' => $order]);
    }
    
    public function approveStoreOrder($id)
    {
        $order = StoreOrder::findOrFail($id);
        $order->status = 'confirmed';
        $order->save();
        return response()->json(['success' => true, 'message' => 'Order approved']);
    }
    
    public function rejectStoreOrder($id)
    {
        $order = StoreOrder::findOrFail($id);
        $order->status = 'rejected';
        $order->save();
        return response()->json(['success' => true, 'message' => 'Order rejected']);
    }
    
    public function cancelStoreOrder($id)
    {
        $order = StoreOrder::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();
        return response()->json(['success' => true, 'message' => 'Order cancelled']);
    }
    
    // Products
    public function getProducts()
    {
        $products = StoreProduct::all();
        return response()->json(['products' => $products]);
    }
    
    public function getProduct($id)
    {
        $product = StoreProduct::findOrFail($id);
        return response()->json(['product' => $product]);
    }
    
    public function storeProduct(Request $request)
    {
        $product = StoreProduct::create($request->all());
        return response()->json(['success' => true, 'product' => $product]);
    }
    
    public function updateProduct(Request $request, $id)
    {
        $product = StoreProduct::findOrFail($id);
        $product->update($request->all());
        return response()->json(['success' => true, 'product' => $product]);
    }
    
    public function deleteProduct($id)
    {
        $product = StoreProduct::findOrFail($id);
        $product->delete();
        return response()->json(['success' => true, 'message' => 'Product deleted']);
    }
    
    // Reservations
    public function getReservations()
    {
        $reservations = Reservation::with('user')->latest()->get();
        return response()->json(['reservations' => $reservations]);
    }
    
    public function updateReservationStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();
        return response()->json(['success' => true, 'message' => 'Status updated']);
    }
    
    public function deleteReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json(['success' => true, 'message' => 'Reservation deleted']);
    }
    
    // Snooker Bookings
    public function getSnookerBookings()
    {
        $bookings = SnookerBooking::with('user')->latest()->get();
        return response()->json(['bookings' => $bookings]);
    }
    
    public function updateBookingStatus(Request $request, $id)
    {
        $booking = SnookerBooking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();
        return response()->json(['success' => true, 'message' => 'Booking status updated']);
    }
    
    public function deleteBooking($id)
    {
        $booking = SnookerBooking::findOrFail($id);
        $booking->delete();
        return response()->json(['success' => true, 'message' => 'Booking deleted']);
    }
    
    // Users
    public function getUsers()
    {
        $users = User::all();
        return response()->json(['users' => $users]);
    }
    
    public function updateUserRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();
        return response()->json(['success' => true, 'message' => 'User role updated']);
    }
    
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Cannot delete super admin'], 403);
        }
        $user->delete();
        return response()->json(['success' => true, 'message' => 'User deleted']);
    }
    
    // Feedbacks
    public function getFeedbacks()
    {
        $feedbacks = StoreFeedback::with('user')->latest()->get();
        return response()->json(['feedbacks' => $feedbacks]);
    }
    
    public function deleteFeedback($id)
    {
        $feedback = StoreFeedback::findOrFail($id);
        $feedback->delete();
        return response()->json(['success' => true, 'message' => 'Feedback deleted']);
    }
    
    // Branches
    public function getBranches()
    {
        $branches = Branch::all();
        return response()->json(['branches' => $branches]);
    }
    
    public function getBranchesList()
    {
        $branches = Branch::where('is_active', true)->get();
        return response()->json(['branches' => $branches]);
    }
    
    public function getBranchStats()
    {
        $branches = Branch::all();
        foreach ($branches as $branch) {
            $branch->reservations_count = Reservation::where('branch_id', $branch->id)->count();
            $branch->orders_count = StoreOrder::where('branch_id', $branch->id)->count();
        }
        return response()->json(['branches' => $branches]);
    }
    
    public function getBranch($id)
    {
        $branch = Branch::findOrFail($id);
        return response()->json(['branch' => $branch]);
    }
    
    public function storeBranch(Request $request)
    {
        $branch = Branch::create($request->all());
        return response()->json(['success' => true, 'branch' => $branch]);
    }
    
    public function updateBranch(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);
        $branch->update($request->all());
        return response()->json(['success' => true, 'branch' => $branch]);
    }
    
    public function deleteBranch($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();
        return response()->json(['success' => true, 'message' => 'Branch deleted']);
    }
    
    public function toggleBranch($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->is_active = !$branch->is_active;
        $branch->save();
        return response()->json(['success' => true, 'is_active' => $branch->is_active]);
    }
    
    public function toggleBranchStatus($id)
    {
        return $this->toggleBranch($id);
    }
}