<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\PaketLayananController;

Route::resource('paket', PaketLayananController::class);