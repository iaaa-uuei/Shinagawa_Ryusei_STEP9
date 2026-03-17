<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PurchaseApiController;

Route::post('/purchase/{product}', [PurchaseApiController::class, 'store']);