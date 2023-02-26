<?php

use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::get('panel', [PanelController::class, 'index']);


Route::get('/promocoes', [SiteController::class,'promotions'])->name('promotions');
Route::get('/', [SiteController::class,'index'])->name('site.index');
