<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\EspecialidadeController;
use App\Http\Controllers\api\MedicoController;
use App\Http\Controllers\api\TelefoneController;
use App\Http\Controllers\api\EspMedController;

Route::apiResource('medicos', MedicoController::class);
Route::apiResource('telefones', TelefoneController::class);
Route::apiResource('especialidades', EspecialidadeController::class);
Route::apiResource('espmed', EspMedController::class);