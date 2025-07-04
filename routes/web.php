<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
 
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {  
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tasks', TaskController::class)->middleware('auth');

    Route::patch('/tasks/{task}/status/{status}', [TaskController::class, 'updateStatus'])->middleware('auth')->name('tasks.updateStatus');
});

require __DIR__.'/auth.php';
