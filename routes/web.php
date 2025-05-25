<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Rutas normales y con parámetros para el proyecto de blog
*/

// Ruta normal - Lista de posts
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts', [PostController::class, 'index'])->name('posts.list');

// Ruta con parámetro - Detalle de post individual
Route::get('/post/{id}', [PostController::class, 'show'])->name('posts.show');

// Ruta adicional para categorías (funcionalidad extra)
Route::get('/categoria/{categoria}', [PostController::class, 'porCategoria'])->name('posts.categoria');