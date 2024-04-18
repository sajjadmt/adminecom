<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::controller(VisitorController::class)->group(function () {
    Route::get('get-visitor', 'GetVisitorDetails');
});

Route::controller(ContactController::class)->group(function () {
    Route::post('post-contact', 'PostContact');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('all-category', 'AllCategoryDetails');
});

Route::controller(ProductListController::class)->group(function () {
    Route::get('product-list-by-remark/{remark}','ProductListByRemark');
});
