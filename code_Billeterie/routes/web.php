<?php

use App\Http\Controllers\DemandeProfessionnelController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UsersController;


use App\Http\Controllers\DashController;
use Illuminate\Pagination\Paginator;

use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\StatistiquesController;
use App\Http\Controllers\FaonctionExterneController;
//BackgroundImageController
use App\Http\Controllers\BackgroundImageController;
use App\Http\Controllers\EventController;
use App\Models\Event;




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


//baground

# Routes accessible sans connexion 



Route::get('api/event/{id}', [FaonctionExterneController::class, 'showAnnonce'])->name('fonct.event');




Route::get('/', [FaonctionExterneController::class, 'welcome'])->name('welcome');

Route::get('/listeevents', [FaonctionExterneController::class, 'listeEvents'])->name('listeevents');

Route::get('/payment/{ticketId}', [FaonctionExterneController::class, 'showPaymentPage'])->name('payment.show');



Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashController::class, 'index'])->name('dashboard');


});












Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});




//routes pour le controlleur events

Route::get('/events_billets', [EventController::class, 'index'])->name('events_billets.index');
Route::get('/events_billets/create', [EventController::class, 'create'])->name('events_billets.create');
Route::post('/events_billets', [EventController::class, 'store'])->name('events_billets.store');
Route::get('/events_billets/{id}/edit', [EventController::class, 'edit'])->name('events_billets.edit');
Route::get('/events_billets/{id}', [EventController::class, 'show'])->name('events_billets.show');
Route::patch('/events_billets/{id}', [EventController::class, 'update'])->name('events_billets.update');
Route::delete('/events_billets/{id}', [EventController::class, 'destroy'])->name('events_billets.destroy');























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
