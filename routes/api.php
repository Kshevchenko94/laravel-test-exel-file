<?php

use App\Http\Controllers\OutputController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

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

Route::post('upload/exel', [UploadController::class, 'exel'])->middleware('auth.basic');
Route::get('output/rows', [OutputController::class, 'output']);
