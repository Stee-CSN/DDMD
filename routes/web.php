<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SnookerController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// ==================== HOME PAGE ====================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==================== BUSINESS PAGES ====================
Route::get('/restaurant', [RestaurantController::class, 'index'])->name('restaurant');
Route::get('/giftshop', function () {
    return view('giftshop');
})->name('giftshop');
Route::get('/shop', [StoreController::class, 'index'])->name('shop');

// ==================== RESTAURANT RESERVATION ROUTES ====================
Route::get('/restaurant/reserve', [RestaurantController::class, 'create'])->name('restaurant.reserve');
Route::get('/my-reservations', [ReservationController::class, 'myReservations'])->name('my-reservations');
Route::get('/reservation/{id}', [ReservationController::class, 'show'])->name('reservation.show');

// ==================== SNOOKER ROUTES ====================
Route::get('/snooker', [SnookerController::class, 'index'])->name('snooker.index');

// ==================== AUTHENTICATION ROUTES ====================
Auth::routes();

// Explicit logout route for ALL users
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// ==================== PROTECTED ROUTES (Requires Login) ====================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard for regular users
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // Profile Routes
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::get('/user/profile', function () {
        return response()->json(auth()->user());
    })->name('user.profile');
    
    Route::put('/user/profile', function (Request $request) {
        $user = auth()->user();
        
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $user->id,
                'phone' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'bio' => 'nullable|string|max:1000',
            ]);
            
            $user->update($request->only(['name', 'email', 'phone', 'address', 'bio']));
            
            return response()->json(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    })->name('user.profile.update');
    
    Route::post('/user/profile/avatar', function (Request $request) {
        try {
            $request->validate([
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            $user = auth()->user();
            
            if ($user->avatar_url && file_exists(public_path($user->avatar_url))) {
                unlink(public_path($user->avatar_url));
            }
            
            $file = $request->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            
            if (!file_exists(public_path('uploads/avatars'))) {
                mkdir(public_path('uploads/avatars'), 0777, true);
            }
            
            $file->move(public_path('uploads/avatars'), $filename);
            
            $avatarUrl = '/uploads/avatars/' . $filename;
            $user->avatar_url = $avatarUrl;
            $user->save();
            
            return response()->json(['success' => true, 'avatar_url' => $avatarUrl]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    })->name('user.profile.avatar');
    
    // ==================== RESTAURANT RESERVATION (Protected) ====================
    Route::post('/reservation/store', [ReservationController::class, 'store'])->name('reservation.store');
    Route::post('/reservation/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservation.cancel');
    
    // Snooker Booking Routes
    Route::post('/snooker/book', [SnookerController::class, 'store'])->name('snooker.book');
    Route::delete('/snooker/{id}', [SnookerController::class, 'destroy'])->name('snooker.destroy');
    
    // Store Routes
    Route::prefix('store')->group(function () {
        Route::get('/products', [StoreController::class, 'getProducts'])->name('store.products');
        Route::post('/place-order', [StoreController::class, 'placeOrder'])->name('store.place.order');
        Route::delete('/cancel-order/{id}', [StoreController::class, 'cancelOrder'])->name('store.cancel.order');
        Route::get('/my-orders', [StoreController::class, 'getMyOrders'])->name('store.my.orders');
        Route::post('/feedback', [StoreController::class, 'submitFeedback'])->name('store.feedback');
    });
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/', function () {
        $user = auth()->user();
        if ($user->is_admin != 1 && $user->role != 'admin' && $user->role != 'super_admin') {
            abort(403, 'Access Denied. Admin privileges required.');
        }
        return redirect()->route('admin.dashboard');
    });
    
    // API Routes
    Route::get('/api/stats', [AdminDashboardController::class, 'getStats']);
    Route::get('/api/store-orders', [AdminDashboardController::class, 'getStoreOrders']);
    Route::post('/api/store-order/{id}/approve', [AdminDashboardController::class, 'approveStoreOrder']);
    Route::post('/api/store-order/{id}/reject', [AdminDashboardController::class, 'rejectStoreOrder']);
    Route::get('/api/reservations', [AdminDashboardController::class, 'getReservations']);
    Route::put('/api/reservation/{id}/status', [AdminDashboardController::class, 'updateReservationStatus']);
    Route::get('/api/snooker-bookings', [AdminDashboardController::class, 'getSnookerBookings']);
    Route::put('/api/snooker-booking/{id}/status', [AdminDashboardController::class, 'updateSnookerStatus']);
    Route::get('/api/users', [AdminDashboardController::class, 'getUsers']);
    Route::put('/api/user/{id}/role', [AdminDashboardController::class, 'updateUserRole']);
    Route::delete('/api/user/{id}', [AdminDashboardController::class, 'deleteUser']);
    Route::get('/api/feedbacks', [AdminDashboardController::class, 'getFeedbacks']);
    Route::delete('/api/feedback/{id}', [AdminDashboardController::class, 'deleteFeedback']);
    Route::get('/api/branches', [AdminDashboardController::class, 'getBranches']);
    Route::post('/api/branches', [AdminDashboardController::class, 'storeBranch']);
    Route::put('/api/branches/{id}', [AdminDashboardController::class, 'updateBranch']);
    Route::delete('/api/branches/{id}', [AdminDashboardController::class, 'deleteBranch']);
    Route::post('/api/branches/{id}/toggle', [AdminDashboardController::class, 'toggleBranch']);
});

// ==================== BRANCH MANAGEMENT ROUTES (Public) ====================
Route::get('/api/branches-list', [AdminDashboardController::class, 'getBranchesList']);