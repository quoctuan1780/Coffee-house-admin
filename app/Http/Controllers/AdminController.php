<?php

namespace App\Http\Controllers;
use App\Sanpham;
use App\Loaisanpham;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{
    public function getSanpham(){
        $sanpham = Sanpham::all();
        $loaisp = Loaisanpham::all();
    	return view('admin.sanpham.danhsachsanpham', compact('sanpham', 'loaisp'));
    }

    public function getThemsanpham(){
        $loaisp = Loaisanpham::all();
    	return view('admin.sanpham.themsanpham', compact('loaisp'));
    }

    public function postThemsanpham(Request $req){
        $this->validate($req,
            [
                'tensp'=>'required',
                'dvt'=>'required',
                'gia'=>'required|numeric',
                'giakm'=>'required|numeric|min:0|max:gia'
            ],
            [
                'tensp.required'=>'Vui lòng nhập tên sản phẩm',
                'dvt.required'=>'Vui lòng nhập dơn vị tính',
                'gia.required'=>'Vui lòng nhập giá',
                'gia.numeric'=>'Giá nhập vào phải là số',
                'giakm.numeric'=>'Giá khuyến mãi nhập vào phải là số',
                'giakm.required'=>'Vui lòng nhập giá khuyến mãi, nếu không khuyến mãi nhập 0',
                'giakm.min'=>'Giá khuyến mãi không được < 0',
                'giakm.max'=>'Giá khuyến mãi không được lớn hơn giá'
            ]);
        DB::table('sanpham')->insert(
            ['tensp' => $req->tensp, 'maloaisp' => $req->loaisp, 'mota' => $req->mota, 'gia' => $req->gia, 'giakm' => $req->giakm,
            'hinhanh' => $req->hinhanh, 'dvt' => $req->dvt]
        );
        return redirect()->back()->with(['Thanhcong' => 'Thêm sản phẩm thành công']);
    }

    public function getXoasanpham($masp){
        DB::table('sanpham')->where('masp', '=', $masp)->delete();
        return redirect()->back()->with(['xoathanhcong' => 'Xóa sản phẩm thành công']);
    }

}
