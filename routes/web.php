<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/hk.php';
Route::get('/', function () {
    return view('welcome');
});
