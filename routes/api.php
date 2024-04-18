<?php

use App\Http\Controllers\VisitorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(VisitorController::class)->group(function () {
    Route::get('get-visitor', 'GetVisitorDetails');
});

Route::controller(\App\Http\Controllers\ContactController::class)->group(function () {
    Route::post('post-contact','PostContact');
});
