<?php

namespace App\Http\Controllers;
use DB;
use App\Sanpham;
use  App\Loaisanpham;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function getTimkiemAjax(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('sanpham')
            ->where('tensp', 'LIKE', "%{$query}%")
            ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
               $output .= '
               <li>'.$row->tensp.'</li>
               ';
           }
           $output .= '</ul>';
           echo $output;
       }
    }

    public function getHienthiAjax(Request $request){
        if($request->get('query'))
        {
            $query = $request->get('query');
            $loaisp = Loaisanpham::all();
            $data = Sanpham::where('tensp', $query)->first();
            $output = '<div class="form-group"><input type="hidden" name="masp" value="'.$data->masp.'" class="form-control"/></div>';
            $output .= '<div class="form-group"><label>Loại sản phẩm</label><select name="loaisp" class="form-control">';
            foreach($loaisp as $loai) 
                $output .= '<option value="'.$loai->maloaisp.'">'.$loai->tenloaisp.'</option>';
            $output .= '</select></div>';
            $output .= '<div class="form-group"><label>Mô tả</label><textarea class="form-control" rows="3" name="mota">'.$data->mota.'</textarea></div>';
            $output .= '<div class="form-group"><label>giá</label><input class="form-control" value="'.$data->gia.'" name="gia" placeholder="39000" required /></div>';
            $output .= '<div class="form-group"><label>giá khuyến mãi</label><input class="form-control" value="'.$data->giakm.'" name="giakm" placeholder="35000" required /></div>';
            $output .= '<div class="form-group"><label>Hình ảnh</label><input type="file" value="'.$data->hinhanh.'" name="hinhanh"></div>';
            $output .= '<div class="form-group"><label>Đơn vị tính</label><input class="form-control" value="'.$data->dvt.'" name="dvt" placeholder="Ly" required /></div>';
           echo $output;
       }
    }
}
