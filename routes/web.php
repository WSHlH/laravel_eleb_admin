<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//管理员路由
Route::resource('user','UserController');
//店铺分类路由
Route::resource('category','BusinessCategoryController');
//注册店铺路由
Route::get('shops','BusinessListController@index')->name('shopIndex');
Route::get('shop','BusinessListController@create')->name('shop');
Route::post('shop','BusinessListController@store')->name('shopSave');
