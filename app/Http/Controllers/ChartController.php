<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
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
}
