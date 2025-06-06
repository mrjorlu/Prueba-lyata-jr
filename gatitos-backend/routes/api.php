<?php

use App\Http\Controllers\api\DesifrarMaullidoController;
use App\Http\Controllers\api\IpController;
use App\Http\Controllers\api\SecuenciaFelinaController;
use Illuminate\Support\Facades\Route;

Route::post('/construir-casitas',   [IpController::class, 'construirCasitas']);
Route::post('/secuencia-siesta',    [SecuenciaFelinaController::class, 'longitudSiesta']);
Route::post('/desifrar-maullido',   [DesifrarMaullidoController::class, 'descifrarMaullido']);
