<?php

use App\Http\Controllers\DemandeProfessionnelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UsersController;

use App\Http\Controllers\AnnoncesController;
//PpmController
use App\Http\Controllers\PpmController;
use App\Http\Controllers\DashController;
use App\Models\Annee;
use App\Http\Controllers\AnneeController;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\SuiviMarcheController;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\StatistiquesController;
//BackgroundImageController
use App\Http\Controllers\BackgroundImageController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

&\hspace{.2cm}{Réalisation du diagramme de cas d'utilisation}\\&\hspace{.2cm}{Réalisation du diagramme de classe}\\
*/

Route::get('/', function () {
    return view('Aceuil.welcome');

    //return view('welcome', compact('annonces'));


})->name('welcome');

//baground



Route::get('/listeannonce', function () {

    //Rércupération de toutes les annonces
    $annonces = Annonce::orderBy('created_at', 'desc')->paginate(9);
       // dd($annonces);
    
        return view('Aceuil.welcome_annonces', compact('annonces'));
        //return view('welcome', compact('annonces'));
    
    
    })->name('listeannonces');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');


});



//Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');

Route::match(['get', 'post'], '/botman', 'App\Http\Controllers\BotManController@handle');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

//annees
Route::get('/annees', [AnneeController::class, 'index'])->name('annees.index');
Route::get('/annees/create', [AnneeController::class, 'create'])->name('annees.create');
Route::post('/annees', [AnneeController::class, 'store'])->name('annees.store');
Route::get('/annees/{id}/edit', [AnneeController::class, 'edit'])->name('annees.edit');
Route::patch('/annees/{id}', [AnneeController::class, 'update'])->name('annees.update');

Route::get('/annees/{id}', [AnneeController::class, 'show'])->name('annees.show');
Route::delete('/annees/{id}', [AnneeController::class, 'destroy'])->name('annees.destroy');

Route::get('/suivi-marches', [SuiviMarcheController::class, 'index'])->name('suivi_marches.index');
Route::get('/suivi-marches/create', [SuiviMarcheController::class, 'create'])->name('suivi_marches.create');
Route::post('/suivi-marches', [SuiviMarcheController::class, 'store'])->name('suivi_marches.store');
Route::get('/suivi-marches/{id}/edit', [SuiviMarcheController::class, 'edit'])->name('suivi_marches.edit');
Route::patch('/suivi-marches/{id}', [SuiviMarcheController::class, 'update'])->name('suivi_marches.update');
Route::get('/suivi-marches/{id}', [SuiviMarcheController::class, 'show'])->name('suivi_marches.show');
Route::delete('/suivi-marches/{id}', [SuiviMarcheController::class, 'destroy'])->name('suivi_marches.destroy');
Route::get('/suivi-enregistrement/create/{id}', [SuiviMarcheController::class, 'create_enregistrement'])->name('create_enregistrement.create');
Route::post('suivi_marches/export', [SuiviMarcheController::class, 'export'])->name('suivi_marches.export');
Route::get('/suivi_marches/imprimer_marcher/{id}', [SuiviMarcheController::class, 'imprimer_marcher'])->name('suivi_marches.imprimer_marcher');
//* ppm
/*
 Route::get('/nationalites/export', [NationaliteController::class, 'export'])->name('nationalites.export');
    Route::post('/nationalites/import', [NationaliteController::class, 'import'])->name('nationalites.import');

*/
Route::post('/ppm/export', [PpmController::class, 'export'])->name('ppm.export');
Route::post('/ppm/import', [PpmController::class, 'import'])->name('ppm.import');

Route::get('/ppm', [PpmController::class, 'index'])->name('ppm.index');
Route::get('/ppm/create', [PpmController::class, 'create'])->name('ppm.create');
Route::post('/ppm', [PpmController::class, 'store'])->name('ppm.store');
Route::get('/ppm/{id}/edit', [PpmController::class, 'edit'])->name('ppm.edit');
Route::patch('/ppm/{id}', [PpmController::class, 'update'])->name('ppm.update');
Route::get('/ppm/{id}', [PpmController::class, 'show'])->name('ppm.show');
Route::delete('/ppm/{id}', [PpmController::class, 'destroy'])->name('ppm.destroy');

//création des routes pour les utilisateurs tout en utilisant le middleware auth
Route::middleware('auth')->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UsersController::class, 'create'])->name('users.create');
    Route::post('/users', [UsersController::class, 'store'])->name('users.store'); // Ajout de la route pour la méthode store

    Route::get('/users/{id}', [UsersController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UsersController::class, 'edit'])->name('users.edit');
    Route::patch('/users/{id}', [UsersController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
    // Route::resource('roles', RoleController::class);

});
//création des routes pour app/Http/Controllers/BackgroundImageController.php

Route::middleware('auth')->group(function () {
    Route::get('/background_image', [BackgroundImageController::class, 'edit'])->name('background_image.edit');
    Route::patch('/background_image', [BackgroundImageController::class, 'update'])->name('background_image.update');
});






Route::get('/export-database', [DatabaseController::class, 'exports'])->name('exports.database');
Route::get('/export-done', [DatabaseController::class, 'done'])->name('exports.done');

Route::get('/import-database', [DatabaseController::class, 'showImportForm'])->name('import.database.form');
Route::post('/import-database', [DatabaseController::class, 'import'])->name('import.database');



Route::get('/statistiques', [StatistiquesController::class, 'index'])->name('statistiques.index');
Route::get('/statistiques/marches-ppms/{id}', [StatistiquesController::class, 'getMarchesParPpm'])->name('statistiques.marches_ppms');
Route::get('/statistiques/montants-ppms/{id}', [StatistiquesController::class, 'getMontantsParPpm'])->name('statistiques.montants_ppms');
Route::get('/statistiques/filtrer-subvention/{id}', [StatistiquesController::class, 'getFiltrerParSubvention'])->name('statistiques.filtrer_subvention');




require __DIR__ . '/auth.php';


Route::get('/index', function () {
    return view('layouts.app');
});

// La page où on présente les liens de redirection vers les providers
//Route::get("login-register", "SocialiteController@loginRegister");

Route::get("login-register", [SocialiteController::class, 'loginRegister']);
Route::get("callback/{provider}", [SocialiteController::class, 'callback'])->name('socialite.callback');
Route::get("redirect/{provider}", [SocialiteController::class, 'redirect'])->name('socialite.redirect');
