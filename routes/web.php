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

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

Route::get('dangxuat', [
	'as'=>'dang-xuat',
	'uses'=>'AccountController@getDangxuat'
]);

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

	Route::get('index', [
		'as'=>'trang-chu',
		'uses'=>'AdminController@getTrangchu'
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
	
	Route::group(['prefix' => 'loaisanpham'], function () {
		Route::get('danhsachloaisanpham', [
			'as'=>'danh-sach-loai-san-pham',
			'uses'=>'AdminController@getLoaisanpham'
		]);

		Route::get('themloaisanpham', [
			'as'=>'them-loai-san-pham',
			'uses'=>'AdminController@getThemloaisanpham'
		]);

		Route::post('themloaisanpham', [
			'as'=>'them-loai-san-pham',
			'uses'=>'AdminController@postThemloaisanpham'
		]);

		Route::get('xoaloaisanpham/{maloaisp}', [
			'as'=>'xoa-loai-san-pham',
			'uses'=>'AdminController@getXoaloaisanpham'
		]);

		Route::get('sualoaisanpham/{maloaisp}', [
			'as'=>'sua-loai-san-pham',
			'uses'=>'AdminController@getSualoaisanpham'
		]);

		Route::post('sualoaisanpham', [
			'as'=>'sua-loai-sp',
			'uses'=>'AdminController@postSualoaisanpham'
		]);
	});

	Route::group(['prefix' => 'donhang'], function () {
		Route::get('danhsachdonhang', [
			'as'=>'danh-sach-don-hang',
			'uses'=>'AdminController@getDonhang'
		]);

		Route::get('xoadonhang/{madh}/{tttt}', [
			'as'=>'xoa-don-hang',
			'uses'=>'AdminController@getXoadonhang'
		]);

		Route::get('chitietdonhang/{madh}', [
			'as'=>'chi-tiet-don-hang',
			'uses'=>'AdminController@getChitietdonhang'
		]);

		Route::get('donhangmoi', [
			'as'=>'don-hang-moi',
			'uses'=>'AdminController@getDonhangmoi'
		]);

		Route::get('thanhtoan', 'AdminController@getThanhtoan')->name('thanhtoan');

		Route::get('timkiemtrangthaiAjax', 'SearchController@getTimkiemtrangthaiAjax')->name('timkiemtrangthaiAjax');
	});

	Route::group(['prefix' => 'taikhoan'], function () {
		Route::get('danhsachtaikhoan', [
			'as'=>'danh-sach-tai-khoan',
			'uses'=>'AccountController@getTaikhoan'
		]);

		Route::get('themtaikhoan', [
			'as'=>'them-tai-khoan',
			'uses'=>'AccountController@getThemtaikhoan'
		]);

		Route::post('themtaikhoan', [
			'as'=>'them-tai-khoan',
			'uses'=>'AccountController@postThemtaikhoan'
		]);

		Route::get('thongtintaikhoan/{id}', [
			'as'=>'thong-tin-tai-khoan',
			'uses'=>'AccountController@getThongtin'
		]);

		Route::get('xoataikhoan/{id}', [
			'as'=>'xoa-tai-khoan',
			'uses'=>'AccountController@getXoataikhoan'
		]);

		Route::get('doimatkhau', [
			'as'=>'doi-mat-khau',
			'uses'=>'AccountController@getDoimatkhau'
		]);

		Route::post('doimatkhau', [
			'as'=>'doi-mat-khau',
			'uses'=>'AccountController@postDoimatkhau'
		]);
	});

	Route::group(['prefix' => 'thongke'], function () {
		Route::get('thongkedoanhthu', [
			'as'=>'thong-ke-doanh-thu',
			'uses'=>'AdminController@getThongke'
		]);

		Route::get('doanhthutheonam', 'ChartController@getDoanhthutheonam')->name('doanhthutheonam');

		Route::get('doanhthutheosanpham', 'ChartController@getDoanhthutheosanpham')->name('doanhthutheosanpham');

		Route::get('doanhthutheophantramloaisanpham', 'ChartController@getDoanhthutheophantramLsp')->name('doanhthutheophantramloaisanpham');
	});

	Route::group(['prefix' => 'khachhang'], function () {
		Route::get('danhsachkhachhang', [
			'as'=>'danh-sach-khach-hang',
			'uses'=>'AdminController@getKhachhang'
		]);

		Route::get('dangkinhantin', [
			'as'=>'dang-ki-nhan-tin',
			'uses'=>'AdminController@getDangkinhantin'
		]);	

		Route::get('dangkinhantinmoi', [
			'as'=>'dang-ki-nhan-tin-moi',
			'uses'=>'AdminController@getDangkinhantinmoi'
		]);	

		Route::get('timkiemkhachhangAjax', 'SearchController@getKhachhang')->name('timkiemkhachhangAjax');
	});

	Route::group(['prefix' => 'phanhoi'], function () {
		Route::get('thongtinphanhoi', [
			'as'=>'thong-tin-phan-hoi',
			'uses'=>'AdminController@getPhanhoi'
		]);

		Route::get('phanhoimoi', [
			'as'=>'phan-hoi-moi',
			'uses'=>'AdminController@getPhanhoimoi'
		]);

		Route::get('xoaphanhoi/{maph}', [
			'as'=>'xoa-phan-hoi',
			'uses'=>'AdminController@getXoaphanhoi'
		]);

		Route::get('laynoidungAjax', 'SearchController@getPhanhoi')->name('laynoidungAjax');
	});
});




