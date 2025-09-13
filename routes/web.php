<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Main application routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/submit-form', [HomeController::class, 'submitForm'])->name('submit.form');
Route::get('/question', [HomeController::class, 'question'])->name('question');
Route::post('/submit-question', [HomeController::class, 'submitQuestion'])->name('submit.question');
Route::get('/result/{page}', [HomeController::class, 'result'])->name('result');

// Admin routes
Route::get('/admin', function() {
    return redirect()->route('admin.dashboard');
})->name('dashboard');
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/content', [AdminController::class, 'index'])->name('content');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{page}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{page}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete/{page}', [AdminController::class, 'destroy'])->name('destroy');
    Route::post('/remove-image/{page}', [AdminController::class, 'removeImage'])->name('remove.image');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
