<?php

use App\Http\Controllers\api\IpController;
use Illuminate\Support\Facades\Route;

Route::post('/construir-casitas', [IpController::class, 'construirCasitas']);
