<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\IT\TicketController as ITTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Employee routes
Route::middleware(['auth', 'role:employee'])->group(function () {
    Route::get('/dashboard', [TicketController::class, 'index'])->name('dashboard');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
});

// IT Support routes
Route::middleware(['auth', 'role:it_support'])->prefix('it')->name('it.')->group(function () {
    Route::get('/tickets', [ITTicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [ITTicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{ticket}/update-status', [ITTicketController::class, 'updateStatus'])->name('tickets.updateStatus');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
