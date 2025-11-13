<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdukController;

Route::resource('produk', ProdukController::class)->middleware(['auth']);


Route::get('/', function () {
    // Kalau udah login, langsung ke dashboard
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    // Kalau belum login, langsung ke halaman login
    return redirect('/login');
});

// setelah login
Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return view('admin.dashboard');
    } else {
        return view('user.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('umkm', App\Http\Controllers\UmkmController::class);
});


require __DIR__.'/auth.php';