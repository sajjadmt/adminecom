<?php

use App\Http\Controllers\User\AuthenticationController;
use App\Http\Controllers\User\CartListController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\FavourtieController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\OrderListController;
use App\Http\Controllers\User\PaymentRuleController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\SiteInfoController;
use App\Http\Controllers\User\SliderController;
use App\Http\Controllers\User\VisitorController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('login', 'Login');
    Route::post('register', 'Register');
    Route::post('forget-password', 'ForgetPassword');
    Route::post('reset-password', 'ResetPassword');
    Route::put('change-password', 'ChangePassword')->middleware(['auth:sanctum']);
    Route::put('change-name', 'ChangeName')->middleware(['auth:sanctum']);
    Route::put('change-address', 'ChangeAddress')->middleware(['auth:sanctum']);
    Route::get('get-user', 'GetUser')->middleware(['auth:sanctum']);
});

Route::controller(VisitorController::class)->group(function () {
    Route::get('get-visitor-details', 'GetVisitorDetails');
});

Route::controller(ContactController::class)->group(function () {
    Route::post('post-contact', 'PostContact');
});

Route::controller(SiteInfoController::class)->group(function () {
    Route::get('all-site-info', 'AllSiteInfo');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('all-category', 'AllCategory');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('product-details/{productSlug}', 'ProductDetails');
    Route::get('product-by-remark/{remark}', 'ProductByRemark');
    Route::get('product-by-brand/{brand}', 'ProductByBrand');
    Route::get('search-result/{key}', 'ProductBySearch');
    Route::get('product-by-category/{categorySlug}', 'ProductByCategory');
    Route::get('product-by-sub-category/{categorySlug}/{subCategorySlug}', 'ProductBySubCategory');
});

Route::controller(SliderController::class)->group(function () {
    Route::get('all-slider', 'AllSlider');
});

Route::controller(NotificationController::class)->group(function () {
    Route::get('{user}/notifications', 'AllNotification');
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('review-list/{productId}', 'ReviewList');
    Route::post('post-review', 'PostReview')->middleware(['auth:sanctum']);
});

Route::controller(CartListController::class)->group(function () {
    Route::post('add-to-cart', 'AddToCart')->middleware(['auth:sanctum']);
    Route::get('cart-count', 'CartCount')->middleware(['auth:sanctum']);
    Route::get('user-cart-list', 'UserCartList')->middleware(['auth:sanctum']);
    Route::post('cart-state', 'CartState')->middleware(['auth:sanctum']);
    Route::post('remove-cart', 'RemoveCart')->middleware(['auth:sanctum']);
    Route::post('quantity-increase', 'QuantityIncrease');
    Route::post('quantity-decrease', 'QuantityDecrease');
});

Route::controller(PaymentRuleController::class)->group(function () {
    Route::get('payment-rules', 'GetPaymentRules');
});

Route::controller(OrderListController::class)->group(function () {
    Route::post('add-to-order-list', 'AddToOrderList')->middleware(['auth:sanctum']);
    Route::get('orders', 'Orders')->middleware(['auth:sanctum']);
});

Route::controller(FavourtieController::class)->group(function () {
    Route::post('add-to-favourite', 'AddToFavourite')->middleware(['auth:sanctum']);
    Route::get('user-favourite-list', 'FavouriteList')->middleware(['auth:sanctum']);
    Route::post('remove-favourite', 'RemoveFavourite')->middleware(['auth:sanctum']);
    Route::post('favourite-state', 'FavouriteState')->middleware(['auth:sanctum']);
});

Route::controller(OrderController::class)->group(function () {

});
