<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\FocusModeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// ✅ Menampilkan halaman login
Route::get('/', function () {
    return view('auth.login');
})->name('login.form');

Route::get('/login', function () {
    return view('auth.login');
});

// ✅ Login manual
Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/main');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
})->name('login');

// ✅ Logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// ✅ Halaman utama setelah login
Route::get('/main', [TodoController::class, 'main'])->name('todos.main');

// ✅ Tambah Todo & Mode Fokus — tanpa login
Route::get('/create', [TodoController::class, 'create'])->name('create');
Route::post('/store-data', [TodoController::class, 'store'])->name('store');
Route::get('/focus-mode', [FocusModeController::class, 'index'])->name('focus.index');

// ✅ Google Auth
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// ✅ Fitur khusus user login
Route::middleware(['auth'])->group(function () {
    // Kalender
    Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [CalendarController::class, 'events'])->name('calendar.events');
    Route::get('/calendar/tasks-by-date', [CalendarController::class, 'tasksByDate'])->name('calendar.tasksByDate');
    Route::post('/calendar/api-store', [TodoController::class, 'apiStore']);

    // Todo lainnya
    Route::get('/edit/{todo}', [TodoController::class, 'edit'])->name('edit');
    Route::put('/update/{todo}', [TodoController::class, 'update'])->name('update');
    Route::get('/delete/{todo}', [TodoController::class, 'delete'])->name('delete');

    Route::post('/update-order', [TodoController::class, 'updateOrder'])->name('todos.updateOrder');
    Route::post('/update-status', [TodoController::class, 'updateStatus'])->name('todos.updateStatus');

    // ✅ Halaman profil
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
});