<?php

use App\Http\Controllers\ExternalApiController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

Route::get('notes', [NotesController::class, 'index']);
Route::post('notes', [NotesController::class, 'store']);
Route::put('notes/{id}', [NotesController::class, 'update']);
Route::delete('notes/{id}', [NotesController::class, 'destroy']);

Route::get('external-posts', [ExternalApiController::class, 'posts']);
Route::get('/weather', [WeatherController::class, 'current']);
