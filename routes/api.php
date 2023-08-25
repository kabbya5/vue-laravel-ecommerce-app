<?php

use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChildcategoryController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('signup', 'AuthController@signup');
    Route::post('/genarate/verification/code/{id}', 'AuthController@genarateEmailVerificationCode');
    Route::post('/verfy/account','AuthController@verifyAccount');
});

Route::group(['middleware' => ['Admin','api'], 'prefix' => 'admin'],
function (){
    Route::controller(CategoryController::class)->group(function(){
        Route::post('/categories/store','store');
        Route::put('/categories/update/{category}','update');
        Route::delete('/categories/delete/{category}','destory');
        Route::get('/trash/categories','trashCategory');
        Route::get('/restore/categories/{slug}', 'restoreCategory');
        Route::delete('/forch/delete/categories/{slug}', 'forchDelete');
    });

    Route::controller(SubcategoryController::class)->group(function(){
        Route::post('/subcategories','index');
        Route::post('/subcategories/store','store');
        Route::put('/subcategories/update/{subcategory}','update');
        Route::delete('/subcategories/delete/{subcategory}','destroy');
        Route::post('/subcategories/restore/{slug}','restore');
        Route::delete('/subcategories/forch/delete/{slug}','forchDelete');
    });

    Route::controller(ChildcategoryController::class)->group(function(){
        Route::post('/childcategories','index');
        Route::post('/childcategories/store','store');
        Route::put('/childcategories/update/{childcategory}', 'update');
        Route::delete('/childcategories/delete/{childcategory}', 'delete');
    });

    Route::controller(SettingController::class)->group(function (){
        Route::post('/setting/store','store');
        Route::put('/setting/update/{setting}','update');
    });
});

Route::get('/admin/categories',[CategoryController::class,'index']);

Route::get('/setting',[SettingController::class,'index']);

