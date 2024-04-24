<?php

use App\Models\Book;
use Illuminate\Support\Facades\Route;

// default view
Route::get('/', function () {
    return view('welcome');
});
