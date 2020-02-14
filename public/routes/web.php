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

use App\models\Categories;




Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
//Route::get('/', function () {
//    $categories = Categories::all();
//    return view('main-page-customer',['categories'=>$categories]);
//})->middleware('auth');
Route::get('/no', function () {
    $categories = Categories::all();
    return view('main-page-customer',['categories'=>$categories]);
})->middleware('auth');


Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index')->name('home');
// пользовательcкий кабинет
Route::group([
    // 'prefix'=>'cars',
    //'as'=>'cars',
    'namespace'=>'Cabinet',
    'middleware'=>['auth'],
], function (){Route::resource('orders', 'OrderController');});
// кабинет менеджера клиенты
Route::group([
    // 'prefix'=>'cars',
    //'as'=>'cars',
    'namespace'=>'Control',
    'middleware'=>['auth','manager_admin'],  //ManagerAdminMiddleware
], function (){Route::resource('customers', 'CustomerController');});
//namespace App\Http\Controllers\Control;
