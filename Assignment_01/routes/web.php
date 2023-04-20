<?php

use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/', '/students');

//Routes for students
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/update/{id}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('students.destroy');

//Routes for majors
Route::get('/majors', [MajorController::class, 'index'])->name('majors.index');
Route::get('/majors/create', [MajorController::class, 'create'])->name('majors.create');
Route::post('/majors/store', [MajorController::class, 'store'])->name('majors.store');
Route::get('/majors/edit/{id}', [MajorController::class, 'edit'])->name('majors.edit');
Route::put('/majors/update/{id}', [MajorController::class, 'update'])->name('majors.update');
Route::delete('/majors/delete/{id}', [MajorController::class, 'destroy'])->name('majors.destroy');