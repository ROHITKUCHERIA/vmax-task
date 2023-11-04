<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('registration',[UserController::class,'showRegistrationForm'])->name('register');
Route::Post('/register',[UserController::class,'registerStore'])->name('user.register');
Route::get('listRecord',[UserController::class,'allRecord'])->name('users.list');
Route::get('view/{id?}',[UserController::class,'view'])->name('view');
Route::get('edit/{id?}',[UserController::class,'edit'])->name('edit');
Route::Post('update/{id?}',[UserController::class,'update'])->name('update');
Route::delete('delete/{id?}',[UserController::class,'delete'])->name('delete');
