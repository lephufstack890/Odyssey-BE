<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SubcribeController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin
Route::get('/admin/contact', [ContactController::class, 'list']);
Route::delete('/admin/contact/{id}', [ContactController::class, 'delete']);

Route::get('/admin/subscribe', [SubcribeController::class, 'list']);
Route::delete('/admin/subscribe/{id}', [SubcribeController::class, 'delete']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('change-password', [AuthController::class, 'changePassword']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Client
Route::post('/contact', [ContactController::class, 'index']);
Route::post('/subcribe', [SubcribeController::class, 'index']);
