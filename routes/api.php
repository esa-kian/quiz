<?php

use App\Http\Controllers\BattleController;
use App\Http\Controllers\BattleQuestionController;
use App\Http\Controllers\BattleroyaleController;
use App\Http\Controllers\BattleroyaleQuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'create']);
Route::get('/users/{id}', [UserController::class, 'read']);
Route::patch('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'delete']);

Route::get('/battles', [BattleController::class, 'index']);
Route::post('/battles', [BattleController::class, 'create']);
Route::get('/battles/{id}', [BattleController::class, 'read']);
Route::patch('/battles/{id}', [BattleController::class, 'update']);
Route::delete('/battles/{id}', [BattleController::class, 'delete']);
Route::post('/battles/{id}/questions', [BattleQuestionController::class, 'create']);
Route::get('/start-battle', [BattleController::class, 'start']);
Route::post('/submit-battle-answer', [BattleController::class, 'submitAnswer']);

Route::get('/battleroyales', [BattleroyaleController::class, 'index']);
Route::post('/battleroyales', [BattleroyaleController::class, 'create']);
Route::get('/battleroyales/{id}', [BattleroyaleController::class, 'read']);
Route::patch('/battleroyales/{id}', [BattleroyaleController::class, 'update']);
Route::delete('/battleroyales/{id}', [BattleroyaleController::class, 'delete']);
Route::get('/start-battleroyale', [BattleroyaleController::class, 'start']);
Route::post('/submit-battleroyale-answer', [BattleroyaleController::class, 'submitAnswer']);


Route::post('/battleroyales/{id}/questions', [BattleroyaleQuestionController::class, 'create']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
