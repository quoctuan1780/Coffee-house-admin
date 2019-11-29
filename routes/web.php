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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin'], function () {

	Route::get('dangnhap', [
		'as'=>'dang-nhap',
		'uses'=>'AccountController@getDangnhap'
	]);
	
	Route::post('dangnhap', [
		'as'=>'dang-nhap',
		'uses'=>'AccountController@postDangnhap'
	]);
	
	Route::get('quenmatkhau', [
		'as'=>'quen-mat-khau',
		'uses'=>'AccountController@getQuenmatkhau'
	]);
	
	Route::post('quenmatkhau', [
		'as'=>'quen-mat-khau',
		'uses'=>'AccountController@postQuenmatkhau'
	]);
	
	Route::get('khoiphuc/{email}/{code}', [
		'as'=>'khoi-phuc',
		'uses'=>'AccountController@getKhoiphuc'
	]);
	
	Route::post('khoiphuc', [
		'as'=>'khoi-phuc',
		'uses'=>'AccountController@postKhoiphuc'
	]);

	Route::group(['prefix' => 'sanpham'], function () {
		Route::get('danhsachsanpham', [
			'as'=>'danh-sach-san-pham',
			'uses'=>'AdminController@getSanpham'
		]);
		
		Route::get('themsanpham', [
			'as'=>'them-san-pham',
			'uses'=>'AdminController@getThemsanpham'
		]);

		Route::post('themsanpham', [
			'as'=>'them-san-pham',
			'uses'=>'AdminController@postThemsanpham'
		]);

		Route::get('xoasanpham/{masp}', [
			'as'=>'xoa-san-pham',
			'uses'=>'AdminController@getXoasanpham'
		]);

		Route::get('suasanpham', [
			'as'=>'sua-san-pham',
			'uses'=>'AdminController@getSuasanpham'
		]);

		Route::post('suasanpham', [
			'as'=>'sua-san-pham',
			'uses'=>'AdminController@postSuasanpham'
		]);

		Route::get('timkiemAjax', 'SearchController@getTimkiemAjax')->name('timkiemAjax');

		Route::get('hienthiAjax', 'SearchController@getHienthiAjax')->name('hienthiAjax');
	});

	
});




