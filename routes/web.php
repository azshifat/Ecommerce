<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

// *************************************** Category Routes Start *************************************** //
Route::controller(CategoryController::class)->group(function () {
    Route::prefix('/category')->group(function () {
        Route::get('/', 'Show')->name('category.show');
        Route::get('/create', 'Create')->name('category.create');
        Route::post('/insert', 'Insert')->name('category.insert');
        Route::get('/edit/{id}', 'Edit')->name('category.edit');
        Route::post('/update/{id}', 'Update')->name('category.update');
        Route::delete('/delete/{id}', 'Delete')->name('category.delete');
        Route::get('/search', 'Search')->name('category.search');
        Route::get('/get', 'Get')->name('category.get');
    });
});


// *************************************** Subcategory Routes Start *************************************** //
Route::controller(SubCategoryController::class)->group(function () {
    Route::prefix('/subcategory')->group(function () {
        Route::get('/', 'Show')->name('subcategory.show');
        Route::get('/create', 'Create')->name('subcategory.create');
        Route::post('/insert', 'Insert')->name('subcategory.insert');
        Route::get('/edit/{id}', 'Edit')->name('subcategory.edit');
        Route::post('/update/{id}', 'Update')->name('subcategory.update');
        Route::delete('/delete/{id}', 'Delete')->name('subcategory.delete');
        Route::get('/search', 'Search')->name('subcategory.search');
        Route::get('/get', 'Get')->name('subcategory.get');
    });
});


// *************************************** Products Routes Start *************************************** //
Route::controller(ProductController::class)->group(function () {
    Route::prefix('/products')->group(function () {
        Route::get('/', 'Show')->name('product.show');
        Route::get('/create', 'Create')->name('product.create');
        Route::post('/insert', 'Insert')->name('product.insert');
        Route::get('/edit/{id}', 'Edit')->name('product.edit');
        Route::post('/update/{id}', 'Update')->name('product.update');
        Route::delete('/delete/{id}', 'Delete')->name('product.delete');
        Route::get('/search', 'Search')->name('product.search');
        Route::get('/get', 'Get')->name('product.get');
    });
});
