<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/profile', [AuthController::class, 'profile'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cars', [CarController::class, 'index']);
    Route::post('/cars', [CarController::class, 'store']);
    Route::delete('/cars/{id}', [CarController::class, 'destroy']);
    Route::put('/cars/{car}', [CarController::class, 'update']);
    Route::get('/cars/{car}', [CarController::class, 'show']);
    Route::post('/reservations', [ReservationController::class, 'store']);
    Route::patch('/reservations/{reservation}/cancel', [ReservationController::class, 'userCancel']);
    Route::get('/my-reservations', [ReservationController::class, 'myReservations']);
    Route::get('/admin/reservations', [ReservationController::class, 'index']);
    Route::patch('/admin/reservations/{reservation}/confirm', [ReservationController::class, 'confirm']);
    Route::patch('/admin/reservations/{reservation}/cancel', [ReservationController::class, 'cancel']);
    Route::get('/admin/dashboard', [AdminController::class , 'dashboard'])->middleware([AdminMiddleware::class]);
    Route::get('/admin/stats', [AdminController::class , 'stats']);
    Route::patch('/cars/{car}/toggle-active', [CarController::class, 'toggleActive']);
    });
    
    
    Route::get('/admin/popular-cars', [ReservationController::class, 'popularCars']);
    Route::get('/public/cars/{car}/reservations', [ReservationController::class, 'carReservations']);
    Route::get('/admin/reservations/status', [AdminController::class, 'reservationsByStatus']);
    Route::get('/brands', [BrandController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/public/cars', [CarController::class, 'publicCars']);
    Route::get('/public/cars/{car}', [CarController::class, 'showPublic']);
