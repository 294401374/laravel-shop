<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    
Route::get('/', 'PagesController@root')->name('root');
// 登录相关路由
Auth::routes();
// 邮箱认证
Auth::routes(['verify' => true]);
// auth 中间件代表需要登录，verified中间件代表需要经过邮箱验证
Route::group(['middleware' => ['auth', 'verified']], function() {
    // 用户地址列表
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
    // 新增&&修改地址页面
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
    // 新增地址
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
});
