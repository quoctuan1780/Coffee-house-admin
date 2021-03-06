<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Facade\FlareClient\View;

class ChartController extends Controller
{
    public function getDoanhthutheosanpham(){
        $chitiet = DB::table('cthd')->join('sanpham', 'cthd.masp', '=', 'sanpham.masp')
        ->select(DB::raw('SUM(soluong*cthd.gia) as y'), 'tensp as label')
        ->groupBy('cthd.masp', 'tensp')
        ->get();
        echo $chitiet;
    }

    public function getDoanhthutheophantramLsp(){
        $chitiet = DB::table('cthd')->join('sanpham', 'cthd.masp', '=', 'sanpham.masp')
                        ->join('loaisanpham', 'sanpham.maloaisp', '=', 'loaisanpham.maloaisp')
                        ->select(DB::raw('SUM(soluong*cthd.gia) as y'), 'tenloaisp as label', DB::raw('SUM(soluong*cthd.gia) as y1'))
                        ->groupBy('sanpham.maloaisp', 'tenloaisp')
                        ->get();
        echo $chitiet;
    }

    public function getDoanhthutheonam(Request $req){
        $chitiet = DB::table('cthd')->join('hoadon', 'cthd.mahd', '=', 'hoadon.mahd')
                                    ->join('sanpham', 'cthd.masp', '=', 'sanpham.masp')
                                    ->join('loaisanpham', 'sanpham.maloaisp', '=', 'loaisanpham.maloaisp')
                                    ->select(DB::raw('SUM(soluong*cthd.gia) as y'), 'tenloaisp as label')
                                    ->whereYear('ngaythanhtoan', '=', $req->nam)
                                    ->groupBy(DB::raw('year(ngaythanhtoan)'),'sanpham.maloaisp', 'tenloaisp')
                                    ->get();
        echo $chitiet;
    }
}
