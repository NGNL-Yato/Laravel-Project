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

Route::get('Educational_Service/indexSalles', function () {
    return view('Educational_Service/indexSalles');
})->name('indexsalle');



Route::get('Professor/announces', function () {
    return view('Professor/announces');
})->name('announces');

Route::get('Professor/emploi', function () {
    return view('Professor/emploi');
})->name('emploi');

Route::get('Professor/indexDemande', function () {
    return view('Professor/indexDemande');
})->name('indexDemande');

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


Route::get('Professor/indexDemande', [App\Http\Controllers\Tables\DemandeController::class, 'listDemande'])->name('Professor.indexDemande');



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

// Description_Filiere View for the Educational_Service View
Route::get('/Educational_Service/info_filiere', [App\Http\Controllers\Tables\DescriptionFormationController::class, 'ListAllDescriptionFormation'])->name('description_formation.index');
Route::post('/Educational_Service/info_filiere', [App\Http\Controllers\Tables\DescriptionFormationController::class, 'store'])->name('description_formation.store');
Route::put('/Educational_Service/info_filiere/{id}', [App\Http\Controllers\Tables\DescriptionFormationController::class, 'update'])->name('description_formation.update');
Route::delete('/Educational_Service/info_filiere/{id}', [App\Http\Controllers\Tables\DescriptionFormationController::class, 'destroy'])->name('description_formation.destroy');

// Class View for the Educational_Service View
Route::get('/Educational_Service/class', [App\Http\Controllers\Tables\ClasseController::class, 'ListALLClass'])->name('classe.index');
Route::post('/Educational_Service/class', [App\Http\Controllers\Tables\ClasseController::class, 'store'])->name('classe.store');
Route::put('/Educational_Service/class/{class}', [App\Http\Controllers\Tables\ClasseController::class, 'update'])->name('classe.update');
Route::delete('/Educational_Service/class/{class}', [App\Http\Controllers\Tables\ClasseController::class, 'destroy'])->name('classe.destroy');

// ClassDepartment for the Educational_Service View

// Salle Routes
Route::get('Educational_Service/Salle', [App\Http\Controllers\Tables\SalleController::class, 'ListALLSalle'])->name('salle.index');
Route::get('Educational_Service/Salle/create', [App\Http\Controllers\Tables\SalleController::class, 'create'])->name('salle.create');
Route::post('Educational_Service/Salle', [App\Http\Controllers\Tables\SalleController::class, 'store'])->name('salle.store');
Route::put('Educational_Service/Salle/{salle}', [App\Http\Controllers\Tables\SalleController::class, 'update'])->name('salle.update');
Route::delete('Educational_Service/Salle/{salle}', [App\Http\Controllers\Tables\SalleController::class, 'destroy'])->name('salle.destroy');

// Etudiant 
Route::get('Educational_Service/etudiant', [App\Http\Controllers\Tables\EtudiantController::class, 'ListALLEtudiant'])->name('etudiant.index');
Route::post('Educational_Service/etudiant', [App\Http\Controllers\Tables\EtudiantController::class, 'store'])->name('etudiant.store');
Route::put('Educational_Service/etudiant/{id}', [App\Http\Controllers\Tables\EtudiantController::class, 'update'])->name('etudiant.update');
Route::delete('Educational_Service/etudiant/{id}', [App\Http\Controllers\Tables\EtudiantController::class, 'destroy'])->name('etudiant.destroy');
Route::post('/Educational_Service/etudiant/filterByClass',[App\Http\Controllers\Tables\EtudiantController::class,'filterByClass'])->name('etudiant.filterByClass');

//Materiel
Route::get('Educational_Service/Materiel', [App\Http\Controllers\Tables\MaterielController::class, 'listAllMateriels'])->name('materiels.index');
Route::post('Educational_Service/Materiel', [App\Http\Controllers\Tables\MaterielController::class, 'store'])->name('materiel.store');
Route::put('Educational_Service/Materiel/{id}', [App\Http\Controllers\Tables\MaterielController::class, 'update'])->name('materiel.update');
Route::delete('Educational_Service/Materiel/{id}', [App\Http\Controllers\Tables\MaterielController::class, 'destroy'])->name('materiel.destroy');
Route::get('/Educational_Service/Materiel/filterBySalle/{salleId}', [App\Http\Controllers\Tables\MaterielController::class, 'filterBySalle'])->name('materiels.filterBySalle');
