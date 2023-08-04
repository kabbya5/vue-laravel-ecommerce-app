<?php

use App\Http\Controllers\InstallController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\CategoryController;


// Route::controller(InstallController::class)->group(function(){
//     Route::get('/','install');
//     Route::post('/store/inastall','storeConfigaration')->name('install.configration.store');
// });

Route::group(['prefix' => 'admin',],function (){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/categories','index');
        Route::post('/categories/store','store');
    });
});

Route::get('/admin/{any}', [AdminDashboardController::class,'index'])->where('any','.*');

Route::view('/','home');
Route::get('{any}', function(){
 return view('home');
})->where('any','.*');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
