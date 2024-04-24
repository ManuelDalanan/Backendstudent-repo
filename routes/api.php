<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogingLogController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeriodicalController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReservationController;

// logged in user tester
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login Routes
Route::post('/login/{subsystem}', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Cataloging Process routes
Route::group(['middleware' => ['auth:sanctum', 'ability:materials:edit']], function () {
    
    // View cataloging logs
    Route::get('/cataloging/logs', [CatalogingLogController::class, 'get']);

    // Add Materials
    Route::post('/books/process', [BookController::class, 'add']);
    Route::post('/periodicals/process', [PeriodicalController::class, 'add']);
    Route::post('/articles/process', [ArticleController::class, 'add']);
    Route::post('/projects/process', [ProjectController::class, 'add']);

    // Update Materials
    Route::put('/books/process/{id}', [BookController::class, 'update']);
    Route::put('/periodicals/process/{id}', [PeriodicalController::class, 'update']);
    Route::put('/articles/process/{id}', [ArticleController::class, 'update']);
    Route::put('/projects/process/{id}', [ProjectController::class, 'update']);

    // Delete Materials
    Route::delete('/books/process/{id}', [BookController::class, 'delete']);
    Route::delete('/periodicals/process/{id}', [PeriodicalController::class, 'delete']);
    Route::delete('/articles/process/{id}', [ArticleController::class, 'delete']);
    Route::delete('/projects/process/{id}', [ProjectController::class, 'delete']);
});

// Material viewing routes
Route::group(['middleware' => ['auth:sanctum', 'ability:materials:view']], function () {
    Route::get('/books', [BookController::class, 'getBooks']);
    Route::get('/periodicals', [PeriodicalController::class, 'getPeriodicals']);
    Route::get('/articles', [ArticleController::class, 'getArticles']);
    Route::get('/projects', [ProjectController::class, 'getProjects']);

    // Get Materials Using ID 
    Route::get('/book/id/{id}', [BookController::class, 'getBook']);
    Route::get('/periodical/id/{id}', [PeriodicalController::class, 'getPeriodical']);
    Route::get('/article/id/{id}', [ArticleController::class, 'getArticle']);
    Route::get('/project/id/{id}', [ProjectController::class, 'getProject']);

    // Get Material Image
    Route::get('/book/image/{id}', [BookController::class, 'image']);
    Route::get('/periodical/image/{id}', [PeriodicalController::class, 'image']);
    Route::get('/project/image/{id}', [ProjectController::class, 'image']);

    // Get Periodicals and Projects Using Type
    Route::get('/periodicals/type/{type}', [PeriodicalController::class, 'getByType']);
    Route::get('/projects/type/{type}', [ProjectController::class, 'getByType']);
});

Route::group(['middleware' => ['auth:sanctum', 'ability:materials:view']], function () {
    // Reservation routes
    Route::post('reservation/{id}', [ReservationController::class, 'reserve']);
    // Reservation Cancel
    Route::delete('/cancel-reservation/{id}', [ReservationController::class, 'cancelReservation']);
    
    
    // API resource route for reservations
    Route::get('reservations', [ReservationController::class, 'index']);
    Route::get('reservations/{reservation}', [ReservationController::class, 'show']);
    Route::put('reservations/{reservation}', [ReservationController::class, 'update']);
    Route::delete('reservations/{reservation}', [ReservationController::class, 'destroy']);
    
    });