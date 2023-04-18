<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// Task Routes
Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::post('/task', [TaskController::class, 'store'])->name('task.store');
Route::delete('/task/{task}', [TaskController::class, 'destroy'])->name('task.destroy');