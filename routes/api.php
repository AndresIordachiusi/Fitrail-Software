<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DialogflowController;

Route::post('/dialogflow', [DialogflowController::class, 'handle']);

require __DIR__ . '/auth.php';