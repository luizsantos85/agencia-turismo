<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\PanelController;

Route::prefix('panel')->group(function(){
    Route::get('/', [PanelController::class, 'index'])->name('panel.index');
    Route::resource('/brands', BrandController::class);
});

Route::get('/promocoes', [SiteController::class,'promotions'])->name('promotions');
Route::get('/', [SiteController::class,'index'])->name('site.index');

Auth::routes();

