<?php

use App\Http\Controllers\BanquetController;
use App\Http\Controllers\ConferenceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PromotionController;
use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{code}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/promotion', [PromotionController::class, 'show'])->name('promotion.index');
Route::get('/conference', [ConferenceController::class, 'index'])->name('conference.index');
Route::get('/banquet/{code}', [BanquetController::class, 'show'])->name('banquet.show');