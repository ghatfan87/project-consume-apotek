<?php

use App\Http\Controllers\ApotekController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/landing', [ApotekController::class,'landing'])->name('landing');
Route::get('/', [ApotekController::class,'index'])->name('home');
Route::get('/add', [ApotekController::class,'create'])->name('add');
Route::post('/add/send',[ApotekController::class,'store'])->name('send');
Route::get('/edit/{id}', [ApotekController::class,'edit'])->name('edit');
Route::patch('/update/{id}', [ApotekController::class,'update'])->name('update');
Route::delete('/delete/{id}',[ApotekController::class,'destroy'])->name('delete');
Route::get('/trash', [ApotekController::class,'trash'])->name('trash'); 
Route::get('/trash/restore/{id}', [ApotekController::class,'restore'])->name('restore');
Route::get('/trash/delete/permanent/{id}', [ApotekController::class,'deletePermanent'])->name('permanent'); 