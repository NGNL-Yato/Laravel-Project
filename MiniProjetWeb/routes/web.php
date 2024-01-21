<?php

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
})->name('welcome'); //Gave a name to it to use it as an automatic redirection

Auth::routes();

Route::middleware(['isAdmin'])->group(function () {
Route::get('auth/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('auth.home');
Route::get('Professor/home', [App\Http\Controllers\Professor\HomeController::class, 'index'])->name('Professor.home');
Route::get('Educational_Service/home', [App\Http\Controllers\Educational_Service\HomeController::class, 'index'])->name('Educational_Service.home');
Route::get('Student/home', [App\Http\Controllers\Student\HomeController::class, 'index'])->name('Student.home');
Route::get('Sector_responsible/home', [App\Http\Controllers\Sector_responsible\HomeController::class, 'index'])->name('Sector_responsible.home');
Route::get('Department_chief/home', [App\Http\Controllers\Department_chief\HomeController::class, 'index'])->name('Department_chief.home');
});

Route::get('Educational_Service/users', [App\Http\Controllers\Tables\UserController::class, 'listUsers']);