<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\SliderController;

use App\Http\Controllers\Backend\SubCategoryController;
use Illuminate\Support\Facades\Route;


/** Admin Routes */
// Route::get('admin.dashboard', [AdminController::class, 'dashboard'])
Route::get('dashboard', [AdminController::class, 'dashboard'])
    // ->middleware('auth','role:admin') // Kernal $middlewareAliases
    // ->name('admin.dashboard');  middleware : RouteServiceProvider.php
    ->name('dashboard');

/** Profile Route  */

Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');

/** Slider Route  */
Route::resource('slider', SliderController::class);

/** Category Route  */
Route::resource('category', CategoryController::class);

/** Sub Category Route  */
Route::resource('sub-category', SubCategoryController::class);

/** Child Category Route  */
Route::get('get-subcategories', [ChildCategoryController::class, 'getSubCategories'])->name('get-subcategories');
Route::resource('child-category', ChildCategoryController::class);

/** Brand Route  */
Route::resource('brand', BrandController::class);

/** Product Route  */
Route::get('product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.get-subcategories');
Route::get('product/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::delete('products/delete-all/{id}', [ProductController::class, 'destroyAll'])->name('products.delete-all');
Route::resource('products', ProductController::class);

/** Product Image Gallery Route  */
Route::resource('products-image-gallery', ProductImageGalleryController::class);

/** Product Variant Route  */
Route::put('products-variant/change-status', [ProductVariantController::class, 'changeStatus'])
->name('products-variant.change-status');
Route::resource('products-variant', ProductVariantController::class);

/** Product Variant Item Route  */
Route::put('products-variant-item/change-status', [ProductVariantItemController::class, 'changeStatus'])
->name('products-variant-item.change-status');

Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item/', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
// Route::get('products-variant-item/{id}/edit', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::get('products-variant-item-edit/{id}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{id}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item/{id}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

/** Flash Sale Route  */
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');

Route::put('flash-sale/change-status', [FlashSaleController::class, 'changeStatus'])
->name('flash-sale.change-status');

Route::put('flash-sale/show-at-home', [FlashSaleController::class, 'showAtHome'])
->name('flash-sale.show-at-home');

Route::put('flash-sale', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::put('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.add-product');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');