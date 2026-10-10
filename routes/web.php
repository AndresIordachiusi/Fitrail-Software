<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EntrenadorController;
use App\Http\Controllers\EntrenamientoController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\SedeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\EntrenadorDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ContentfulController;

use Illuminate\Support\Facades\Route;



Route::get('/', [ContentfulController::class, 'headers'])->middleware('guest')->name('inicio');


//Rutas con Middleware Admin
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
});


//Rutas con Middleware Client
Route::prefix('clients')->middleware(['auth', 'client'])->name('clients.')->group(function () {
    Route::get('/paso-2', [PlanController::class, 'plan'])->name('paso-2');

    Route::middleware('client.has.plan')->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
        Route::post('/reservar/{clientId}/{entrenamientoId}', [ClientController::class, 'reservar'])->name('reservar');
        Route::get('/reservas', [ClientDashboardController::class, 'reservas'])->name('reservas');
        Route::post('/peso-sesion', [ClientDashboardController::class, 'registrarPesoSesion'])->name('peso.registrar');
        Route::patch('/reservas/{reserva}/cancelar', [ClientDashboardController::class, 'cancelarReserva'])->name('reservas.cancelar');
    });
});

// Rutas especificas con Middleware entrenador 
Route::prefix('entrenadors')->middleware(['auth', 'entrenador'])->name('entrenadors.')->group(function () {
    Route::get('/dashboard', [EntrenadorDashboardController::class, 'index'])->name('dashboard');
});


// Api Rest para el admin usando su middleware, control total.
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::resource('sedes', SedeController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('entrenadors', EntrenadorController::class);
    Route::resource('entrenamientos', EntrenamientoController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('seguimientos', SeguimientoController::class);
    Route::resource('users', UserController::class);
});

//Api rest para el entrenador, unicamente CRUD de entrenamientos
Route::prefix('entrenador')->name('entrenador.')->middleware(['auth', 'entrenador'])->group(function () {
    Route::resource('entrenamientos', EntrenamientoController::class);
});

//Retornar planes propios de cada cliente
Route::prefix('client')->name('client.')->middleware(['auth', 'client'])->group(function () {
    Route::get('plans', [PlanController::class, 'index'])->middleware('client.has.plan')->name('index');
});

Route::post('/checkout/{plan}', [PaymentController::class, 'checkout'])
    ->middleware(['auth', 'client'])
    ->name('checkout');

// Stripe redirección OK
Route::get('/success/{plan}', [PaymentController::class, 'success'])
    ->middleware(['auth', 'client'])
    ->name('payment.success');

// Stripe cancelado
Route::get('/cancel', [PaymentController::class, 'cancel'])
    ->middleware(['auth', 'client'])
    ->name('payment.cancel');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





// Route::get('/tips', [ContentfulController::class, 'tips'])->name('tips.index');

require __DIR__ . '/auth.php';
