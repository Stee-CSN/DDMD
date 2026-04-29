<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SnookerController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================== HOME PAGE ====================
Route::get('/', function () {
    return view('home');
})->name('home');

// ==================== BUSINESS PAGES ====================
Route::get('/restaurant', function () {
    return view('restaurant');
})->name('restaurant');

Route::get('/giftshop', function () {
    return view('giftshop');
})->name('giftshop');

Route::get('/shop', function () {
    return view('shop');
})->name('shop');

// ==================== SNOOKER ROUTES (Public - anyone can view) ====================
Route::get('/snooker', [SnookerController::class, 'index'])->name('snooker.index');

// ==================== AUTHENTICATION ROUTES ====================
Auth::routes();

// ==================== PROTECTED ROUTES (Requires Login) ====================
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    // ==================== PROFILE ROUTES ====================
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
    
    // ==================== SNOOKER BOOKING ROUTES (Protected) ====================
    Route::post('/snooker/book', [SnookerController::class, 'store'])->name('snooker.book');
    Route::delete('/snooker/{id}', [SnookerController::class, 'destroy'])->name('snooker.destroy');
});

// ==================== ADMIN ROUTES ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        if (auth()->user()->is_admin != 1 && auth()->user()->role != 'admin') {
            abort(403, 'Access Denied');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');
});