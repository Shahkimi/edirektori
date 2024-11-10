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

//Route::get('/', function () {return view('welcome');});
Route::get('/', 'PegawaiController@carian')->name('pegawai.carian');

Route::get('/pegawai', 'PegawaiController@index')->name('pegawai.index');
Route::get('/pegawai/create', 'PegawaiController@create')->name('pegawai.create')->middleware('can:manage-users');
Route::get('/pegawai/search', 'PegawaiController@search')->name('pegawai.search');
Route::get('/pegawai/carian', 'PegawaiController@carian')->name('pegawai.carian');
Route::post( '/pegawai', 'PegawaiController@store')->name('pegawai.store');
Route::get('/pegawai/{id}', 'PegawaiController@show')->name('pegawai.show')->middleware('auth') ;
Route::delete('/pegawai/{id}', 'PegawaiController@destroy')->name('pegawai.destroy')->middleware('auth');
Route::get('/pegawai/edit/{id}', 'PegawaiController@edit')->name('pegawai.edit')->middleware('auth');
Route::post('/pegawai/edit', 'PegawaiController@update')->middleware('auth');

Route::get('/pegawai/getUnit/{id}', 'PegawaiController@getUnit')->name('pegawai.getUnit');

Route::get('/kawalan/jawatan', 'KawalanController@index_jawatan')->name('kawalan.index_jawatan')->middleware('auth');
Route::get('/kawalan/jawatan/create', 'KawalanController@create_jawatan')->name('kawalan.create_jawatan');
Route::get('/kawalan/jawatan/search', 'KawalanController@search_jawatan')->name('kawalan.search_jawatan')->middleware('auth');
Route::get('/kawalan/jawatan/{id}', 'KawalanController@show_jawatan')->name('kawalan.show_jawatan')->middleware('auth') ;
Route::post( '/kawalan/jawatan', 'KawalanController@store_jawatan')->name('kawalan.store_jawatan');
Route::delete('/kawalan/jawatan/{id}', 'KawalanController@destroy_jawatan')->name('kawalan.destroy_jawatan')->middleware('auth');
Route::get('/kawalan/jawatan/edit/{id}', 'KawalanController@edit_jawatan')->name('kawalan.edit_jawatan')->middleware('auth');
Route::post('/kawalan/jawatan/edit', 'KawalanController@update_jawatan')->middleware('auth');

Route::get('/kawalan/gred', 'KawalanController@index_gred')->name('kawalan.index_gred')->middleware('auth');
Route::get('/kawalan/gred/create', 'KawalanController@create_gred')->name('kawalan.create_gred');
Route::get('/kawalan/gred/search', 'KawalanController@search_gred')->name('kawalan.search_gred');
Route::get('/kawalan/gred/{id}', 'KawalanController@show_gred')->name('kawalan.show_gred')->middleware('auth') ;
Route::post( '/kawalan/gred', 'KawalanController@store_gred')->name('kawalan.store_gred');
Route::delete('/kawalan/gred/{id}', 'KawalanController@destroy_gred')->name('kawalan.destroy_gred')->middleware('auth');
Route::get('/kawalan/gred/edit/{id}', 'KawalanController@edit_gred')->name('kawalan.edit_gred')->middleware('auth');
Route::post('/kawalan/gred/edit', 'KawalanController@update_gred')->middleware('auth');

Route::get('/kawalan/bahagian', 'KawalanController@index_bahagian')->name('kawalan.index_bahagian')->middleware('auth');
Route::get('/kawalan/bahagian/create', 'KawalanController@create_bahagian')->name('kawalan.create_bahagian');
Route::get('/kawalan/bahagian/search', 'KawalanController@search_bahagian')->name('kawalan.search_bahagian');
Route::get('/kawalan/bahagian/{id}', 'KawalanController@show_bahagian')->name('kawalan.show_bahagian')->middleware('auth') ;
Route::post( '/kawalan/bahagian', 'KawalanController@store_bahagian')->name('kawalan.store_bahagian');
Route::delete('/kawalan/bahagian/{id}', 'KawalanController@destroy_bahagian')->name('kawalan.destroy_bahagian')->middleware('auth');
Route::get('/kawalan/bahagian/edit/{id}', 'KawalanController@edit_bahagian')->name('kawalan.edit_bahagian')->middleware('auth');
Route::post('/kawalan/bahagian/edit', 'KawalanController@update_bahagian')->middleware('auth');

Route::get('/kawalan/unit', 'KawalanController@index_unit')->name('kawalan.index_unit')->middleware('auth');
Route::get('/kawalan/unit/create', 'KawalanController@create_unit')->name('kawalan.create_unit');
Route::get('/kawalan/unit/search', 'KawalanController@search_unit')->name('kawalan.search_unit');
Route::get('/kawalan/unit/{id}', 'KawalanController@show_unit')->name('kawalan.show_unit')->middleware('auth') ;
Route::post( '/kawalan/unit', 'KawalanController@store_unit')->name('kawalan.store_unit');
Route::delete('/kawalan/unit/{id}', 'KawalanController@destroy_unit')->name('kawalan.destroy_unit')->middleware('auth');
Route::get('/kawalan/unit/edit/{id}', 'KawalanController@edit_unit')->name('kawalan.edit_unit')->middleware('auth');
Route::post('/kawalan/unit/edit', 'KawalanController@update_unit')->middleware('auth');

Auth::routes([
	'register' => false
]);

Route::get('/home', 'PegawaiController@index')->name('home');

Route::get('/admin/users/reset', 'admin\UsersController@resetpassword')->name('admin.users.reset')->middleware('auth');
Route::post('/admin/users/reset', 'admin\UsersController@changePassword')->name('admin.users.changePassword')->middleware('auth');
Route::get('/admin/users/', 'admin\UsersController@index')->name('admin.users.index')->middleware('auth');
Route::get('/admin/users/create', 'admin\UsersController@create')->name('admin.users.create')->middleware('auth');
Route::get('/admin/users/search', 'admin\UsersController@search')->name('admin.users.search')->middleware('auth');
//Route::get('/admin/users/{id}', 'admin\UsersController@show')->name('admin.users.show')->middleware('auth');
Route::post('/admin/users/', 'admin\UsersController@store')->name('admin.users.store')->middleware('auth');
//Route::delete('/admin/users/{id}', 'admin\UsersController@destroy')->name('admin.users.destroy')->middleware('auth');
Route::get('/admin/users/edit/{id}', 'admin\UsersController@edit')->name('admin.users.edit')->middleware('auth');
Route::post('/admin/users/edit', 'admin\UsersController@update')->name('admin.users.update')->middleware('auth');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
	Route::resource('/users','UsersController',['except' =>['show']]);
});


