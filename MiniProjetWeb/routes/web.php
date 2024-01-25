<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


//Index Educational_Service
Route::get('Educational_Service/indexformations', function () {
    return view('Educational_Service/indexformations');
})->name('indexformations');

Route::get('Educational_Service/indexSalles', function () {
    return view('Educational_Service/indexSalles');
})->name('indexsalle');
    
Route::get('Department_chief/indexDemande', function () {
    return view('Department_chief/indexDemande');
})->name('indexDemande');

Route::get('Department_chief/indexEmploi', function () {
    return view('Department_chief/indexEmploi');
})->name('indexEmploi');


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

Route::get('/Educational_Service/emploidutemps', [App\Http\Controllers\Other\EmploidutempsController::class, 'index'])->name('emploidutemps.index');

//Module
Route::get('/Educational_Service/module', [App\Http\Controllers\Tables\ModuleController::class, 'index'])->name('modules.index');
Route::post('/Educational_Service/module', [App\Http\Controllers\Tables\ModuleController::class, 'store'])->name('modules.store');
Route::put('/Educational_Service/module/{module}', [App\Http\Controllers\Tables\ModuleController::class, 'update'])->name('modules.update');
Route::delete('/Educational_Service/module/{module}', [App\Http\Controllers\Tables\ModuleController::class, 'destroy'])->name('modules.destroy');

//Cours
Route::get('/Educational_Service/cours', [App\Http\Controllers\Tables\CoursController::class, 'index'])->name('cours.index');
Route::post('/Educational_Service/cours', [App\Http\Controllers\Tables\CoursController::class, 'store'])->name('cours.store');
Route::put('/Educational_Service/cours/{cours}', [App\Http\Controllers\Tables\CoursController::class, 'update'])->name('cours.update');
Route::delete('/Educational_Service/cours/{cours}', [App\Http\Controllers\Tables\CoursController::class, 'destroy'])->name('cours.destroy');

// Demandes for Students
Route::get('/Student/Demande', [App\Http\Controllers\Tables\DemandeController::class, 'index'])->name('Student.Demande');
Route::post('/Student/Demande', [App\Http\Controllers\Tables\DemandeController::class, 'store'])->name('student.store');
Route::delete('/Student/Demande/{demande}', [App\Http\Controllers\Tables\DemandeController::class, 'destroy'])->name('student.destroy');

// Annonces all type of users
Route::get('/Department_chief/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'index'])->name('departmentChief.annonces');
Route::get('/Student/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'annoncesCombinedEtudiants'])->name('student.annonces');
Route::get('/annonces/professeurs', [App\Http\Controllers\Tables\AnnoncesController::class, 'annoncesForProfesseurs'])->name('annonces.professeurs');
Route::get('/annonces/general', [App\Http\Controllers\Tables\AnnoncesController::class, 'annoncesForGeneral'])->name('annonces.general');
Route::get('/annonces/etudiants', [App\Http\Controllers\Tables\AnnoncesController::class, 'annoncesForEtudiants'])->name('annonces.etudiants');
Route::post('/Department_chief/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'store'])->name('annonce.store');
Route::put('/Department_chief/annonces/{annonces}', [App\Http\Controllers\Tables\AnnoncesController::class, 'update'])->name('annonce.update');
Route::delete('/Department_chief/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'destroy'])->name('annonce.destroy');

// Add this route for Educational_Service
Route::get('/Educational_Service/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'annoncesForEducationalService'])->name('educationalService.annonces');
Route::post('/Educational_Service/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'storeForEducationalService'])->name('educationalService.storeAnnonce');
Route::put('/Educational_Service/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'updateForEducationalService'])->name('educationalService.updateAnnonce');
Route::delete('/Educational_Service/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'destroyForEducationalService'])->name('educationalService.destroyAnnonce');

// Add this route for Sector_responsible
Route::get('/Sector_responsible/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'classesForChefDeFiliere'])->name('sector_responsible.annonces');
Route::post('Sector_responsible/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'storeForChefDeFiliere'])->name('sector_responsible.storeAnnonce');
Route::put('Sector_responsible/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'updateForChefDeFiliere'])->name('sector_responsible.updateAnnonce');
Route::delete('Sector_responsible/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'destroyForChefDeFiliere'])->name('sector_responsible.destroyAnnonce');

//Informations all users
Route::get('/Professor/Informations', [App\Http\Controllers\InformationsController::class, 'showProfInformations'])->name('professor.informations');
Route::get('/Student/Informations', [App\Http\Controllers\InformationsController::class, 'showEtudiantInformations'])->name('student.informations');
Route::get('/Sector_responsible/Informations', [App\Http\Controllers\InformationsController::class, 'showSectorResponsibleInformations'])->name('Sector_responsible.informations');
Route::get('/Department_chief/Informations', [App\Http\Controllers\InformationsController::class, 'showDepartmentChiefInformations'])->name('Department_chief.informations');
Route::get('/Educational_Service/Informations', [App\Http\Controllers\InformationsController::class, 'showProfInformations'])->name('professor.informations');


//Annonces professor
Route::get('/Professor/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'annoncesForProfessor'])->name('professor.annonces');
Route::post('/Professor/annonces', [App\Http\Controllers\Tables\AnnoncesController::class, 'storeForProfessor'])->name('professor.storeAnnonce');
Route::put('/Professor/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'updateForProfessor'])->name('professor.updateAnnonce');
Route::delete('/Professor/annonces/{annonce}', [App\Http\Controllers\Tables\AnnoncesController::class, 'destroyForProfessor'])->name('professor.destroyAnnonce');


//Response
Route::post('/response/store/{demande}', [App\Http\Controllers\Tables\ResponseController::class, 'store'])->name('response.store');


//Demande for professor
Route::get('/Professor/Demande', [App\Http\Controllers\Tables\DemandeController::class, 'showProfessor'])->name('Professor.Demande');
Route::post('/Professor/Demande', [App\Http\Controllers\Tables\DemandeController::class, 'storeForProfessor'])->name('professors.store');
Route::delete('/Professor/Demande/{demande}', [App\Http\Controllers\Tables\DemandeController::class, 'destroyForProfessor'])->name('professors.destroy');

//Reponse for professor
Route::post('/responses', [App\Http\Controllers\Tables\ResponseController::class, 'store'])->name('responses.store');

//general routes
Route::get('/Emploi', [App\Http\Controllers\Tables\SceanceController::class, 'index'])->name('Emploi.index');
Route::post('/Emploi', [App\Http\Controllers\Tables\SceanceController::class, 'store'])->name('Emploi.store');
Route::put('/Emploi/{emploi}', [App\Http\Controllers\Tables\SceanceController::class, 'update'])->name('Emploi.update');
Route::delete('/Emploi/{emploi}', [App\Http\Controllers\Tables\SceanceController::class, 'destroy'])->name('Emploi.destroy');
//chief departement routes
Route::post('/Chief_Department/Emploi', [App\Http\Controllers\Tables\SceanceController::class, 'storeByChief'])->name('Chief_Department.Emploi.store');
Route::put('/Chief_Department/Emploi/{emploi}', [App\Http\Controllers\Tables\SceanceController::class, 'updateByChief'])->name('Chief_Department.Emploi.update');
Route::delete('/Chief_Department/Emploi/{emploi}', [App\Http\Controllers\Tables\SceanceController::class, 'destroyByChief'])->name('Chief_Department.Emploi.destroy');

//ALl views/index
Route::get('/Student/Emploidutemps', [App\Http\Controllers\Tables\SceanceController::class, 'showForStudent'])->name('Student.Emploidutemps');
Route::get('/Chief_Department/Emploidutemps', [App\Http\Controllers\Tables\SceanceController::class, 'showForChief'])->name('Chief_Department.Emploidutemps');
Route::get('/Sector_responsible/Emploidutemps', [App\Http\Controllers\Tables\SceanceController::class, 'showForFiliereProf'])->name('Sector_responsible.Emploidutemps');
Route::get('/Professor/emploidutemps', [App\Http\Controllers\Tables\SceanceController::class, 'showCoursesForProf'])->name('professor.emploidutemps');

