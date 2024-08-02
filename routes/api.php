<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\LawyerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Rotas para CRUD de pessoas
Route::apiResource('people', PersonController::class);

// Rota para buscar uma pessoa pelo CPF
Route::get('people/cpf/{cpf}', [PersonController::class, 'findByCpf']);

// Rotas para CRUD de advogados
Route::apiResource('lawyers', LawyerController::class);

// Rota para buscar um advogado pelo OAB
Route::get('lawyers/oab/{oab}', [LawyerController::class, 'findByOab']);
