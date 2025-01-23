<?php

use App\Http\Controllers\BanquetHallController;
use App\Http\Controllers\CapacityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConferenceRoomController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\IntroductionController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\TableController;
use App\Models\BanquetHallContent;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('introductions', IntroductionController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('promotions', PromotionController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('capacities', CapacityController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('gifts', GiftController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('ingredients', IngredientController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('meals', MealController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('tables', TableController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('conferences', ConferenceRoomController::class);
});
Route::prefix('admin')->group(function () {
    Route::resource('banquet_halls', BanquetHallController::class);
});
Route::prefix('admin')->group(function () {
    Route::get('contents/create/{hall_code}', [ContentController::class, 'create'])->name('contents.create');
    Route::resource('contents', ContentController::class)->except(['create']);
});
