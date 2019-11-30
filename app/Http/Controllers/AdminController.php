<?php

namespace App\Http\Controllers;
use App\Sanpham;
use App\Loaisanpham;
use Illuminate\Http\Request;
use DB;

class AdminController extends Controller
{

    public function getTrangchu(){
        return view('admin.index');
    }

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

    public function getSuasanpham()
    {
        $loaisp = Loaisanpham::all();
        return view('admin.sanpham.suasanpham', compact('loaisp'));
    }

    public function postSuasanpham(Request $req){
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
        DB::table('sanpham')
            ->where('masp', $req->masp)
            ->update(['tensp' => $req->tensp, 'maloaisp' => $req->loaisp, 'mota' => $req->mota, 'gia' => $req->gia, 'giakm' => $req->giakm,
            'hinhanh' => $req->hinhanh, 'dvt' => $req->dvt]); 
        return redirect()->back()->with(['Thanhcong' => 'Cập nhật sản phẩm thành công']);
    }

    public function getLoaisanpham(){
        $loaisanpham = Loaisanpham::all();
        return view('admin.loaisanpham.danhsachloaisanpham', compact('loaisanpham'));
    }

    public function getThemloaisanpham(){
        return view('admin.loaisanpham.themloaisanpham');
    }

    public function postThemloaisanpham(Request $req){
        $this->validate($req,
            [
                'tenloaisp'=>'required',
            ],
            [
                'tenloaisp.required'=>'Vui lòng nhập tên loại sản phẩm',
            ]);  
        $loaisp = Loaisanpham::where('tenloaisp', $req->tenloaisp)->get();
        if($loaisp == null) return redirect()->back()->with(['loi' => 'Loại sản phẩm đã tồn tại trong hệ thống']);
        else
            DB::table('loaisanpham')->insert(['tenloaisp' => $req->tenloaisp]);
        return redirect()->back()->with(['thanhcong' => 'Thêm loại sản phẩm thành công']);
    }

    public function getXoaloaisanpham($maloaisp){
        $sanpham = Sanpham::where('maloaisp', $maloaisp)->get();
        dd($sanpham);
        exit(0);
        if(is_null($sanpham)){
            DB::table('loaisanpham')->where('maloaisp', '=', $maloaisp)->delete();
            return redirect()->back()->with(['thanhcong' => 'Xóa loại sản phẩm thành công']);
        }
        else{
            return redirect()->back()->with(['loi' => 'Sản phẩm còn đang được sử dụng, vui lòng xóa các sản phẩm con trước']);
        }
    }
}
