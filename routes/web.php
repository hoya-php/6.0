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

//default route

//Route::get('/', function () {
//    return view('welcome');
//});

//カレンダー用ルート　
//参考　https://qiita.com/taka027/items/bb2c5de4677c30c17737
Route::get('/holiday','CalendarController@getHoliday');
Route::post('/holiday','CalendarController@postHoliday');
Route::get('/','CalendarController@index');
Route::get('/holiday/{id}','CalendarController@getHolidayId');
Route::delete('/holiday','CalendarController@deleteHoliday');

// シフト作成
//　オリジナル
Route::get('/shifts/create','MembersController@index');


//問い合わせ用ルート　
//参考　https://blog.capilano-fw.com/?p=1783
//Route::get('/contact', 'ContactController@input'); // 入力ページ
//Route::post('/contact', 'ContactController@send'); // 送信ページ（Ajax）

//メンバー管理ルート
//参考 https://qiita.com/sutara79/items/4d4854d0f1137aed20d4
Route::get('/members', 'MembersController@show');


//auth
//Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');
