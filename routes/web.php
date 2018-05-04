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
Route::get('userRole/{userRole}/edit','UserController@userRole')->name('userRole');
Route::post('userRoleSave/{userRoleSave}','UserController@userRoleSave')->name('userRoleSave');
//管理员登录路由
Route::get('login','LoginController@show')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::delete('logout','LoginController@destroy')->name('logout');
//店铺分类路由
Route::resource('category','BusinessCategoryController');
//注册店铺路由
Route::resource('businessList','BusinessListController');
//Route::get('business','BusinessListController@status')->name('status');
//添加食品分类
//Route::resource('foodCategory','FoodCategoryController');
//添加针对店铺活动路由
Route::resource('businessActivity','BusinessActivityController');

//配置上传图片路由
Route::post('/businessListAdd','UploadController@businessList');
Route::post('/businessCatAdd','UploadController@businessCatAdd');

Route::get('/oss', function()
{
    $client = App::make('aliyun-oss');
    $client->putObject("lavarel-eleb", "2.txt", "hi");
    $result = $client->getObject("lavarel-eleb", "2.txt");
    echo $result;
});

//Route::resource('order','OrderController');
Route::resource('orders','OrderController');
//Route::get('range','OrderController@range')->name('range');

Route::resource('customer','CustomerController');

//权限添加
Route::resource('permission','PermissionController');
//添加角色
Route::resource('role','RoleController');