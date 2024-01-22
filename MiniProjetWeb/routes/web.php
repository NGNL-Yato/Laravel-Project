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

Route::get('Educational_Service/indexformations', function () {
    return view('Educational_Service/indexformations');
})->name('indexformations');

Auth::routes();

// Need to recheck the routes for each page 
// Route::middleware(['isAdmin'])
//      ->namespace('App\Http\Controllers\Educational_Service')
//      ->prefix('Educational_Service')
//      ->group(function () {
//          Route::get('/users', 'UserController@index')->name('Educational_Service.users');
//          // Other Educational Service routes...
//      });

Route::middleware(['isAdmin'])->group(function () {
Route::get('auth/home', [App\Http\Controllers\Auth\HomeController::class, 'home'])->name('auth.home');
Route::get('Professor/home', [App\Http\Controllers\Professor\HomeController::class, 'home'])->name('Professor.home');
Route::get('Educational_Service/home', [App\Http\Controllers\Educational_Service\HomeController::class, 'home'])->name('Educational_Service.home');
Route::get('Student/home', [App\Http\Controllers\Student\HomeController::class, 'home'])->name('Student.home');
Route::get('Sector_responsible/home', [App\Http\Controllers\Sector_responsible\HomeController::class, 'home'])->name('Sector_responsible.home');
Route::get('Department_chief/home', [App\Http\Controllers\Department_chief\HomeController::class, 'home'])->name('Department_chief.home');
});

//Users View for the Educational_Service View
Route::get('Educational_Service/users', [App\Http\Controllers\Tables\UserController::class, 'listUsers'])->name('Educational_Service.users');
Route::delete('/users/{user}', [App\Http\Controllers\Tables\UserController::class, 'destroy'])->name('user.delete');
Route::put('/users/{user}', [App\Http\Controllers\Tables\UserController::class, 'update'])->name('user.update');
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

//Formations View for the Educational_Service View
Route::get('Educational_Service/formation', [App\Http\Controllers\Tables\FormationController::class,'listALLFormation'])->name('formations.index');
Route::post('/formation', [App\Http\Controllers\Tables\FormationController::class, 'store'])->name('formations.store');
Route::delete('/formation/{formation}', [App\Http\Controllers\Tables\FormationController::class,'destroy'])->name('formations.destroy');
Route::put('/formation/{formation}', [App\Http\Controllers\Tables\FormationController::class, 'update'])->name('formations.update');

//Professeurs View for the Educational_Service View
Route::get('/Educational_Service/professeur', [App\Http\Controllers\Tables\ProfesseurController::class, 'listALLProfesseur'])->name('professeurs.index');
Route::post('/Educational_Service/professeur', [App\Http\Controllers\Tables\ProfesseurController::class, 'store'])->name('professeurs.store');
Route::put('/Educational_Service/professeur/{professeur}', [App\Http\Controllers\Tables\ProfesseurController::class, 'update'])->name('professeurs.update');
Route::delete('/Educational_Service/professeur/{professeur}', [App\Http\Controllers\Tables\ProfesseurController::class, 'destroy'])->name('professeurs.destroy');

//Departement View for the Educational_Service View
Route::get('/Educational_Service/departement', [App\Http\Controllers\Tables\DepartementController::class, 'listAllDepartements'])->name('departements.index');
Route::post('/Educational_Service/departement', [App\Http\Controllers\Tables\DepartementController::class, 'store'])->name('departements.store');
Route::put('/Educational_Service/departement/{departement}', [App\Http\Controllers\Tables\DepartementController::class, 'update'])->name('departements.update');
Route::delete('/Educational_Service/departement/{departement}', [App\Http\Controllers\Tables\DepartementController::class, 'destroy'])->name('departements.destroy');

// Filiere View for the Educational_Service View
Route::get('/Educational_Service/filiere', [App\Http\Controllers\Tables\FiliereController::class, 'ListALLFiliere'])->name('filieres.index');
Route::post('/Educational_Service/filiere', [App\Http\Controllers\Tables\FiliereController::class, 'store'])->name('filieres.store');
Route::put('/Educational_Service/filiere/{filiere}', [App\Http\Controllers\Tables\FiliereController::class, 'update'])->name('filieres.update');
Route::delete('/Educational_Service/filiere/{filiere}', [App\Http\Controllers\Tables\FiliereController::class, 'destroy'])->name('filieres.destroy');

// Filiere View for the Educational_Service View
