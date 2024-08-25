<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageGeneratorController;
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

Route::post('/generate_image', [ImageGeneratorController::class, 'ImageGenerator']);

Route::post('/ImageGeneratorUsingSpeech',[ImageGeneratorController::class,'ImageGeneratorUsingSpeech']);
Route::post('/generate',[ImageGeneratorController::class,'generateVideo']);
Route::get('/download-image', [ImageGeneratorController::class, 'downloadImage']);
Route::post('/image_to_image',[ImageGeneratorController::class,'image_to_image']);
