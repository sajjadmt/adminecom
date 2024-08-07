<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CartOrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;

Route::controller(VisitorController::class)->group(function () {
    Route::get('get-visitor', 'GetVisitorDetails');
});

Route::controller(SiteInfoController::class)->group(function () {
    Route::get('all-site-info', 'GetAllSiteInfo');
});

Route::controller(ContactController::class)->group(function () {
    Route::post('post-contact', 'PostContact');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('all-category', 'AllCategoryDetails');
});

Route::controller(ProductListController::class)->group(function () {
    Route::get('product-list-by-remark/{remark}', 'ProductListByRemark');
    Route::get('product-list-by-category/{category}', 'ProductListByCategory');
    Route::get('suggested-products/{subCategoryId}', 'SuggestedProducts');
});

Route::controller(HomeSliderController::class)->group(function () {
    Route::get('all-slider', 'AllSlider');
});

Route::controller(ProductDetailsController::class)->group(function () {
    Route::get('product-details/{id}', 'ProductDetails');
});

Route::controller(NotificationController::class)->group(function () {
    Route::get('notifications', 'AllNotification');
});

Route::controller(SearchController::class)->group(function () {
    Route::get('search/{key}', 'SearchByProduct');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('login', 'Login');
    Route::post('register', 'Register');
    Route::post('forget-password', 'ForgetPassword');
    Route::post('reset-password', 'ResetPassword');
    Route::get('user', 'GetUser')->middleware(['auth:sanctum']);
});

Route::controller(ProductReviewController::class)->group(function () {
    Route::get('review-list/{product_id}', 'ReviewList');
    Route::post('post-review/{userId}', 'PostReview');
});

Route::controller(ProductCartController::class)->group(function () {
    Route::post('add-to-cart', 'AddToCart');
    Route::get('delete-cart/{userId}/{productId}', 'DeleteCart');
    Route::get('cart-list/{userId}', 'CartList');
    Route::get('cart-count/{userId}', 'CartCount');
    Route::get('quantity-increase/{id}', 'QuantityIncrease');
    Route::get('quantity-decrease/{id}', 'QuantityDecrease');
});

Route::controller(FavouriteController::class)->group(function () {
    Route::post('add-to-favourite/{userId}/{productId}/{productDetailsId}', 'AddToFavourite');
    Route::get('get-favourite/{userId}', 'GetFavourite');
    Route::get('delete-favourite/{userId}/{productId}', 'DeleteFavourite');
});

Route::controller(CartOrderController::class)->group(function () {
    Route::post('add-to-order/{userId}','AddToOrder');
    Route::get('order-history/{userId}','OrderHistory');
});
