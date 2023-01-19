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

//ユーザーログイン画面を表示
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function() {

        //商品情報一覧画面表示
    Route::get('/list', 'ProductController@showList')->name('list');

    Route::GET('/serch', "ProductController@exeSerch")->name('serch');

    //商品情報登録画面表示
    Route::get('/commodity', 'ProductController@showCommodity')->name('commodity');

    //商品登録
    Route::post('/store', "ProductController@exeStore")->name('store');

    //商品情報詳細画面表示
    Route::get('/detail/{id}', 'ProductController@showDetail')->name('detail');

    //商品情報編集画面表示
    Route::get('/edit/{id}', 'ProductController@showEdit')->name('edit');

    Route::post('/update', "ProductController@exeUpdate")->name('update');

    //商品削除
    Route::post('/delete/{id}', "ProductController@exeDelete")->name('delete');

});