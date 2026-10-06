<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LivroController;

Route::get('/books', [LivroController::class, 'index']);
Route::get('/books/{book}', [LivroController::class, 'show']);
Route::post('/books', [LivroController::class, 'store']);
Route::put('/books/{book}', [LivroController::class, 'update']);
Route::delete('/books/{book}', [LivroController::class, 'destroy']);