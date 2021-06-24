<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * Метод для отображения всех статей
 *
 */
Route::get('article/all', [ArticleController::class, 'index']);

/**
 * Метод для добавления статьи
 *
 */
Route::post('article/add', [ArticleController::class, 'store']);

/**
 * Метод для отображения конкретной статьи
 *
 */
Route::get('article/{id}', [ArticleController::class, 'show']);

/**
 * Метод для изменения конкретной статьи
 *
 */
Route::put('article/edit/{id}', [ArticleController::class, 'update']);

/**
 * Метод для удаление конкретной статьи
 *
 */
Route::delete('article/delete/{id}', [ArticleController::class, 'destroy']);
