<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\AddressController;
use App\Http\Controllers\User\AttributeController;
use App\Http\Controllers\User\BrandController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\ColorController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\MaterialController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\SiteInfoController;
use App\Http\Controllers\User\SizeController;
use App\Http\Controllers\User\SliderController;
use App\Http\Controllers\User\SpecificationController;
use App\Http\Controllers\User\UnitController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\VariantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

//Authentication
Route::controller(AdminController::class)->prefix('admin')->group(function () {
    Route::get('/logout', 'UserLogout')->name('user.logout');
    Route::get('/profile', 'UserProfile')->name('user.profile');
    Route::post('/profile/store', 'UserProfileStore')->name('user.profile.store');
    Route::get('/profile/change-password', 'UserProfileChangePassword')->name('user.profile.changePassword');
    Route::post('/profile/update-password', 'UserProfileUpdatePassword')->name('user.profile.updatePassword');
})->middleware('auth:sanctum');

//Category
Route::controller(CategoryController::class)->prefix('admin')->group(function () {
    Route::get('/all-category', 'Categories')->name('panel.categories');
    Route::get('category-search', 'CategorySearch')->name('panel.category.search');
    Route::get('/create-category', 'CreateCategory')->name('panel.create.category');
    Route::post('/store-category', 'StoreCategory')->name('panel.store.category');
    Route::get('/delete-category/{id}', 'DeleteCategory')->name('panel.delete.category');
    Route::get('/edit-category/{id}', 'EditCategory')->name('panel.edit.category');
    Route::post('/update-category', 'UpdateCategory')->name('panel.update.category');
})->middleware('auth:sanctum');

//Slider
Route::controller(SliderController::class)->prefix('admin')->group(function () {
    Route::get('all-slider', 'Sliders')->name('panel.sliders');
    Route::get('create-slider', 'CreateSlider')->name('panel.create.slider');
    Route::post('store-slider', 'StoreSlider')->name('panel.store.slider');
    Route::get('edit-slider/{id}', 'EditSlider')->name('panel.edit.slider');
    Route::post('update-slider', 'UpdateSlider')->name('panel.update.slider');
    Route::get('delete-slider/{id}', 'DeleteSlider')->name('panel.delete.slider');
})->middleware('auth:sanctum');

//Product
Route::controller(ProductController::class)->prefix('admin')->group(function () {
    Route::get('all-product', 'Products')->name('panel.products');
    Route::get('product-search', 'ProductSearch')->name('panel.product.search');
    Route::get('product-detail/{id}', 'ProductDetail')->name('panel.product.detail');
    Route::get('product-variants/{id}', 'ProductVariants')->name('panel.product.variants');
    Route::get('create-product', 'CreateProduct')->name('panel.create.product');
    Route::post('store-product', 'StoreProduct')->name('panel.store.product');
    Route::get('delete-product/{id}', 'DeleteProduct')->name('panel.delete.product');
    Route::get('edit-product/{id}', 'EditProduct')->name('panel.edit.product');
    Route::post('update-product', 'UpdateProduct')->name('panel.update.product');
})->middleware('auth:sanctum');

//Variant
Route::controller(VariantController::class)->prefix('admin')->group(function () {
    Route::get('create-variant/{id}', 'CreateVariant')->name('panel.create.variant');
    Route::post('store-variant', 'StoreVariant')->name('panel.store.variant');
    Route::get('delete-variant/{id}', 'DeleteVariant')->name('panel.delete.variant');
    Route::get('edit-variant/{id}', 'EditVariant')->name('panel.edit.variant');
    Route::post('update-variant', 'UpdateVariant')->name('panel.update.variant');
})->middleware('auth:sanctum');

//Specification
Route::controller(SpecificationController::class)->prefix('admin')->group(function () {
    Route::get('all-specification', 'Specifications')->name('panel.specifications');
    Route::get('specification-search', 'SpecificationSearch')->name('panel.specification.search');
    Route::get('specification-attributes/{id}', 'SpecificationAttributes')->name('panel.specification.attributes');
    Route::post('specification-toggle-status', 'SpecificationToggleStatus')->name('panel.specification.toggle.status');
    Route::get('create-specification', 'CreateSpecification')->name('panel.create.specification');
    Route::post('store-specification', 'StoreSpecification')->name('panel.store.specification');
    Route::get('edit-specification/{id}', 'EditSpecification')->name('panel.edit.specification');
    Route::post('update-specification/', 'UpdateSpecification')->name('panel.update.specification');
    Route::get('delete-specification/{id}', 'DeleteSpecification')->name('panel.delete.specification');
})->middleware('auth:sanctum');

//Attribute
Route::controller(AttributeController::class)->prefix('admin')->group(function () {
    Route::get('all-attribute', 'Attributes')->name('panel.attributes');
    Route::get('attribute-search', 'AttributeSearch')->name('panel.attribute.search');
    Route::post('attribute-toggle-status', 'AttributeToggleStatus')->name('panel.attribute.toggle.status');
    Route::get('create-attribute/{id}', 'CreateAttribute')->name('panel.create.attribute');
    Route::post('store-attribute', 'StoreAttribute')->name('panel.store.attribute');
    Route::get('edit-attribute/{id}', 'EditAttribute')->name('panel.edit.attribute');
    Route::post('update-attribute/', 'UpdateAttribute')->name('panel.update.attribute');
    Route::get('delete-attribute/{id}', 'DeleteAttribute')->name('panel.delete.attribute');
})->middleware('auth:sanctum');

//Units
Route::controller(UnitController::class)->prefix('admin')->group(function () {
    Route::get('all-unit', 'Units')->name('panel.units');
    Route::get('unit-search', 'UnitSearch')->name('panel.unit.search');
    Route::post('unit-toggle-status', 'UnitToggleStatus')->name('panel.unit.toggle.status');
    Route::get('create-unit', 'CreateUnit')->name('panel.create.unit');
    Route::post('store-unit', 'StoreUnit')->name('panel.store.unit');
    Route::get('edit-unit/{id}', 'EditUnit')->name('panel.edit.unit');
    Route::post('update-unit/', 'UpdateUnit')->name('panel.update.unit');
    Route::get('delete-unit/{id}', 'DeleteUnit')->name('panel.delete.unit');
})->middleware('auth:sanctum');

//Colors
Route::controller(ColorController::class)->prefix('admin')->group(function () {
    Route::get('all-color', 'Colors')->name('panel.colors');
    Route::get('color-search', 'ColorSearch')->name('panel.color.search');
    Route::post('color-toggle-status', 'ColorToggleStatus')->name('panel.color.toggle.status');
    Route::get('create-color', 'CreateColor')->name('panel.create.color');
    Route::post('store-color', 'StoreColor')->name('panel.store.color');
    Route::get('edit-color/{id}', 'EditColor')->name('panel.edit.color');
    Route::post('update-color/', 'UpdateColor')->name('panel.update.color');
    Route::get('delete-color/{id}', 'DeleteColor')->name('panel.delete.color');
})->middleware('auth:sanctum');

//Brands
Route::controller(BrandController::class)->prefix('admin')->group(function () {
    Route::get('all-brand', 'Brands')->name('panel.brands');
    Route::get('brand-search', 'BrandSearch')->name('panel.brand.search');
    Route::post('brand-toggle-status', 'BrandToggleStatus')->name('panel.brand.toggle.status');
    Route::get('create-brand', 'CreateBrand')->name('panel.create.brand');
    Route::post('store-brand', 'StoreBrand')->name('panel.store.brand');
    Route::get('edit-brand/{id}', 'EditBrand')->name('panel.edit.brand');
    Route::post('update-brand/', 'UpdateBrand')->name('panel.update.brand');
    Route::get('delete-brand/{id}', 'DeleteBrand')->name('panel.delete.brand');
})->middleware('auth:sanctum');

//Users
Route::controller(UserController::class)->prefix('admin')->group(function () {
    Route::get('all-user', 'Users')->name('panel.users')->middleware('can:edit-user');
    Route::get('user-search', 'UserSearch')->name('panel.user.search')->middleware('can:edit-user');
    Route::post('user-toggle-status', 'UserToggleStatus')->name('panel.user.toggle.status')->middleware('can:edit-user');
    Route::get('create-user', 'CreateUser')->name('panel.create.user')->middleware('can:edit-user');
    Route::post('store-user', 'StoreUser')->name('panel.store.user')->middleware('can:edit-user');
    Route::get('edit-user/{id}', 'EditUser')->name('panel.edit.user')->middleware('can:edit-user');
    Route::post('update-user/', 'UpdateUser')->name('panel.update.user')->middleware('can:edit-user');
    Route::post('change-user-password/', 'ChangeUserPassword')->name('panel.user.change.password')->middleware('can:edit-user');
    Route::get('delete-user/{id}', 'DeleteUser')->name('panel.delete.user')->middleware('can:edit-user');
})->middleware('auth:sanctum');

//Address
Route::controller(AddressController::class)->prefix('admin')->group(function () {
    Route::post('store-address', 'StoreAddress')->name('panel.store.address')->middleware('can:edit-user');
    Route::get('delete-address/{id}', 'DeleteAddress')->name('panel.delete.address')->middleware('can:edit-user');
})->middleware('auth:sanctum');

//Materials
Route::controller(MaterialController::class)->prefix('admin')->group(function () {
    Route::get('all-material', 'Materials')->name('panel.materials');
    Route::get('material-search', 'MaterialSearch')->name('panel.material.search');
    Route::post('material-toggle-status', 'MaterialToggleStatus')->name('panel.material.toggle.status');
    Route::get('create-material', 'CreateMaterial')->name('panel.create.material');
    Route::post('store-material', 'StoreMaterial')->name('panel.store.material');
    Route::get('edit-material/{id}', 'EditMaterial')->name('panel.edit.material');
    Route::post('update-material/', 'UpdateMaterial')->name('panel.update.material');
    Route::get('delete-material/{id}', 'DeleteMaterial')->name('panel.delete.material');
})->middleware('auth:sanctum');

//Sizes
Route::controller(SizeController::class)->prefix('admin')->group(function () {
    Route::get('all-size', 'Sizes')->name('panel.sizes');
    Route::get('size-search', 'SizeSearch')->name('panel.size.search');
    Route::post('size-toggle-status', 'SizeToggleStatus')->name('panel.size.toggle.status');
    Route::get('create-size', 'CreateSize')->name('panel.create.size');
    Route::post('store-size', 'StoreSize')->name('panel.store.size');
    Route::get('edit-size/{id}', 'EditSize')->name('panel.edit.size');
    Route::post('update-size/', 'UpdateSize')->name('panel.update.size');
    Route::get('delete-size/{id}', 'DeleteSize')->name('panel.delete.size');
})->middleware('auth:sanctum');

//Site Information
Route::controller(SiteInfoController::class)->prefix('admin')->group(function () {
    Route::get('about-us', 'AboutUs')->name('panel.about-us');
    Route::post('update-about-us', 'UpdateAboutUs')->name('panel.update.about-us');
    Route::get('refund-policy', 'RefundPolicy')->name('panel.refund-policy');
    Route::post('update-refund-policy', 'UpdateRefundPolicy')->name('panel.update.refund-policy');
    Route::get('purchase-policy', 'PurchasePolicy')->name('panel.purchase-policy');
    Route::post('update-purchase-policy', 'UpdatePurchasePolicy')->name('panel.update.purchase-policy');
    Route::get('privacy-policy', 'PrivacyPolicy')->name('panel.privacy-policy');
    Route::post('update-privacy-policy', 'UpdatePrivacyPolicy')->name('panel.update.privacy-policy');
    Route::get('address', 'Address')->name('panel.address');
    Route::post('update-address', 'UpdateAddress')->name('panel.update.address');
    Route::get('links', 'Links')->name('panel.links');
    Route::post('update-links', 'UpdateLinks')->name('panel.update.links');
})->middleware('auth:sanctum');

//Reviews
Route::controller(ReviewController::class)->prefix('admin')->group(function () {
    Route::get('all-review', 'Reviews')->name('panel.reviews');
    Route::get('review-search', 'ReviewSearch')->name('panel.review.search');
    Route::post('review-toggle-status', 'ReviewToggleStatus')->name('panel.review.toggle.status');
    Route::get('edit-review/{id}', 'EditReview')->name('panel.edit.review');
    Route::post('update-review/', 'UpdateReview')->name('panel.update.review');
    Route::get('delete-review/{id}', 'DeleteReview')->name('panel.delete.review');
})->middleware('auth:sanctum');

//Notifications
Route::controller(NotificationController::class)->prefix('admin')->group(function () {
    Route::get('all-notification', 'Notifications')->name('panel.notifications');
    Route::get('notification-search', 'NotificationSearch')->name('panel.notification.search');
    Route::post('notification-toggle-status', 'NotificationToggleStatus')->name('panel.notification.toggle.status');
    Route::get('show-notification/{id}', 'ShowNotification')->name('panel.notification.show');
    Route::get('delete-notification/{id}', 'DeleteNotification')->name('panel.delete.notification');
})->middleware('auth:sanctum');

//Contacts
Route::controller(ContactController::class)->prefix('admin')->group(function () {
    Route::get('all-contact', 'Contacts')->name('panel.contacts');
    Route::get('contact-search', 'ContactSearch')->name('panel.contact.search');
    Route::post('contact-toggle-status', 'ContactToggleStatus')->name('panel.contact.toggle.status');
    Route::get('show-contact/{id}', 'ShowContact')->name('panel.contact.show');
    Route::get('delete-contact/{id}', 'DeleteContact')->name('panel.delete.contact');
})->middleware('auth:sanctum');

//Orders
Route::controller(OrderController::class)->prefix('admin')->group(function () {
    Route::get('all-order', 'Orders')->name('panel.orders');
    Route::get('order-list/{id}', 'OrderList')->name('panel.order.list');
    Route::get('completed-order', 'CompletedOrder')->name('panel.completed.order');
    Route::get('processing-order', 'ProcessingOrder')->name('panel.processing.order');
    Route::get('pending-order', 'PendingOrder')->name('panel.pending.order');
    Route::get('canceled-order', 'CancelledOrder')->name('panel.cancelled.order');
    Route::get('order-search', 'OrderSearch')->name('panel.order.search');
    Route::get('edit-order/{id}', 'EditOrder')->name('panel.edit.order');
    Route::post('update-order/', 'UpdateOrder')->name('panel.update.order');
    Route::get('delete-order/{id}', 'DeleteOrder')->name('panel.delete.order');
    Route::get('delete-order-list/{id}', 'DeleteOrderList')->name('panel.delete.order.list');
})->middleware('auth:sanctum');


