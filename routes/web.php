<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Main application routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/submit-form', [HomeController::class, 'submitForm'])->name('submit.form');
Route::get('/question', [HomeController::class, 'question'])->name('question');
Route::post('/submit-question', [HomeController::class, 'submitQuestion'])->name('submit.question');
Route::get('/result/{page}', [HomeController::class, 'result'])->name('result');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/create', [AdminController::class, 'create'])->name('create');
    Route::post('/store', [AdminController::class, 'store'])->name('store');
    Route::get('/edit/{page}', [AdminController::class, 'edit'])->name('edit');
    Route::put('/update/{page}', [AdminController::class, 'update'])->name('update');
    Route::delete('/delete/{page}', [AdminController::class, 'destroy'])->name('destroy');
    Route::post('/remove-image/{page}', [AdminController::class, 'removeImage'])->name('remove.image');
});
