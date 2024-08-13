<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\TicketController;
use App\Http\Controllers\API\OrderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route pour consulter la liste des événements en cours
Route::get('/events', [EventController::class, 'index'])->name('events.index');

// Route pour consulter la liste des types de tickets disponibles pour un événement donné
Route::get('/events/{event}/ticket-types', [TicketController::class, 'showTicketTypes'])->name('events.ticket-types');

// Route pour créer une intention de commande
Route::post('/orders/intent', [OrderController::class, 'storeIntent'])->name('orders.intent.store');

// Route pour valider une intention de commande
Route::post('/orders/intent/{intent}/validate', [OrderController::class, 'validateIntent'])->name('orders.intent.validate');

// (Bonus) Route pour consulter toutes les commandes effectuées par un client
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');