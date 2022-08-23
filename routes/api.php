<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StateController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CityController;

Route::get('states', [StateController::class, 'index']);
Route::post('states', [StateController::class, 'store']);
Route::get('states/{id}', [StateController::class, 'show']);
Route::put('states/{id}', [StateController::class, 'update']);
Route::delete('states/{id}', [StateController::class, 'destroy']);

Route::get('cities', [CityController::class, 'index']);
Route::post('cities', [CityController::class, 'store']);
Route::get('cities/{id}', [CityController::class, 'show']);
Route::put('cities/{id}', [CityController::class, 'update']);
Route::delete('cities/{id}', [CityController::class, 'destroy']);

Route::get('addresses', [AddressController::class, 'index']);
Route::post('addresses', [AddressController::class, 'store']);
Route::get('addresses/{id}', [AddressController::class, 'show']);
Route::put('addresses/{id}', [AddressController::class, 'update']);
Route::delete('addresses/{id}', [AddressController::class, 'destroy']);

Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::delete('users/{id}', [UserController::class, 'destroy']);