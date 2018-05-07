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

//管理员登录路由
//Route::get('login','LoginController@show')->name('login');
//Route::post('login','LoginController@store')->name('login');
//Route::delete('logout','LoginController@destroy')->name('logout');
//    //管理员路由
//    Route::resource('user','UserController');
//    Route::get('userRole/{userRole}/edit','UserController@userRole')->name('userRole');
//    Route::post('userRoleSave/{userRoleSave}','UserController@userRoleSave')->name('userRoleSave');
//
////店铺分类路由
//    Route::resource('category','BusinessCategoryController');
////注册店铺路由
//    Route::resource('businessList','BusinessListController');
////Route::get('business','BusinessListController@status')->name('status');
////添加食品分类
////Route::resource('foodCategory','FoodCategoryController');
////添加针对店铺活动路由
//    Route::resource('businessActivity','BusinessActivityController');
//
////配置上传图片路由
//    Route::post('/businessListAdd','UploadController@businessList');
//    Route::post('/businessCatAdd','UploadController@businessCatAdd');
//
//    Route::get('/oss', function()
//    {
//        $client = App::make('aliyun-oss');
//        $client->putObject("lavarel-eleb", "2.txt", "hi");
//        $result = $client->getObject("lavarel-eleb", "2.txt");
//        echo $result;
//    });
//
////Route::resource('order','OrderController');
//    Route::resource('orders','OrderController');
////Route::get('range','OrderController@range')->name('range');
////会员路由
//    Route::resource('customer','CustomerController');
//    //权限添加
//    Route::resource('permission','PermissionController');
////添加角色
//    Route::resource('role','RoleController');
////动态菜单
//    Route::resource('menu','MenuController');
////视图显示菜单
////Route::get('menus','MenuController@menus')->name('menus');



Route::get('login','LoginController@show')->name('login');
Route::post('login','LoginController@store')->name('login');
Route::delete('logout','LoginController@destroy')->name('logout');
//会员管理,登录  ==权限
Route::group([ 'middleware' => ['role:admin|admin1|admin2']], function() {
    //管理员登录路由

//    Route::resource('user','UserController');
    //会员管理
    Route::resource('customer','CustomerController');
    //销量统计
    //Route::resource('order','OrderController');
    Route::resource('orders','OrderController');
//Route::get('range','OrderController@range')->name('range');
});

//上传图片,店铺  ==权限
Route::group([ 'middleware' => ['role:admin|admin1']], function() {
    //配置上传图片路由
    Route::post('/businessListAdd','UploadController@businessList');
    Route::post('/businessCatAdd','UploadController@businessCatAdd');
    //店铺分类路由
    Route::resource('category','BusinessCategoryController');
//注册店铺路由
    Route::resource('businessList','BusinessListController');
    //添加针对店铺活动路由
    Route::resource('businessActivity','BusinessActivityController');
});

//管理员,权限,角色,菜单  ==权限
Route::group([ 'middleware' => ['role:admin']], function() {
    //管理员路由
//    Route::resource('user','UserController');
    Route::get('userRole/{userRole}/edit','UserController@userRole')->name('userRole');
    Route::post('userRoleSave/{userRoleSave}','UserController@userRoleSave')->name('userRoleSave');

    //权限添加
    Route::resource('permission','PermissionController');
//添加角色
    Route::resource('role','RoleController');
//动态菜单
    Route::resource('menu','MenuController');
    //视图显示菜单
//Route::get('menus','MenuController@menus')->name('menus');
});
Route::resource('user','UserController');
//Route::group([ 'middleware' => ['permission:user.create|user.store|user.edit|user.update|user.destroy']], function() {
//
//});
//测试发送邮件
Route::get('/mail',function(){
    \Illuminate\Support\Facades\Mail::send(
        'mail',//邮件视图模板
        ['name'=>'张三'],
        function ($message){
            $message->to('1764674098@qq.com')->subject('订单确认');
        }
    );
    return '邮件发送成功';
});

//抽奖活动表
Route::resource('event','EventController');
Route::get('prize/{prize}','EventController@prize')->name('prize');
//抽奖活动奖品表
Route::resource('eventPrize','EventPrizeController');
//商家抽奖
Route::resource('eventBusiness','EventBusinessController');