<?php

use App\Http\Controllers\Panel\AirportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\CityController;
use App\Http\Controllers\Panel\FlightController;
use App\Http\Controllers\Panel\PlaneController;
use App\Http\Controllers\Panel\StateController;

Route::prefix('panel')->group(function(){
    Route::get('/', [PanelController::class, 'index'])->name('panel.index');

    Route::any('/brands/search', [BrandController::class,'search'])->name('brands.search');
    Route::get('/brands/planes/{id}', [BrandController::class,'planes'])->name('brands.planes');
    Route::resource('/brands', BrandController::class);

    Route::any('/planes/search', [PlaneController::class,'search'])->name('planes.search');
    Route::resource('/planes', PlaneController::class);

    Route::any('/states/search', [StateController::class,'search'])->name('states.search');
    Route::get('/states', [StateController::class,'index'])->name('states.index');

    Route::any('/states/{initials}/cities/search', [CityController::class,'search'])->name('cities.search');
    Route::get('/states/{initials}/cities', [CityController::class,'index'])->name('cities.index');

    Route::any('/flights/search', [FlightController::class,'search'])->name('flights.search');
    Route::resource('/flights', FlightController::class);


    Route::resource('city/{id}/airports', AirportController::class);

});

Route::get('/promocoes', [SiteController::class,'promotions'])->name('promotions');
Route::get('/', [SiteController::class,'index'])->name('site.index');

Auth::routes();

