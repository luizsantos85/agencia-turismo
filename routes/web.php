<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\PlaneController;

Route::prefix('panel')->group(function(){
    Route::get('/', [PanelController::class, 'index'])->name('panel.index');
    Route::any('/brands/search', [BrandController::class,'search'])->name('brands.search');
    Route::get('/brands/planes/{id}', [BrandController::class,'planes'])->name('brands.planes');
    Route::resource('/brands', BrandController::class);
    Route::any('/planes/search', [PlaneController::class,'search'])->name('planes.search');
    Route::resource('/planes', PlaneController::class);

});

Route::get('/promocoes', [SiteController::class,'promotions'])->name('promotions');
Route::get('/', [SiteController::class,'index'])->name('site.index');

Auth::routes();

