<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/todo')->name('todo.')->group(base_path('routes/todoapp/todo.php'));
