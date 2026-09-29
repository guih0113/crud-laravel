<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LivroController;

Route::get('/livros', [LivroController::class, 'index']);
Route::get('/livros/{livro}', [LivroController::class, 'show']);
Route::post('/livros', [LivroController::class, 'store']);
Route::put('/livros/{livro}', [LivroController::class, 'update']);
Route::delete('/livros/{livro}', [LivroController::class, 'destroy']);