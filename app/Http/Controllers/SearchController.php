<?php

namespace App\Http\Controllers;
use DB;
use App\Khachhang;
use App\Sanpham;
use App\Donhang;
use App\Loaisanpham;

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

    public function getTimkiemtrangthaiAjax(Request $req){
        $tttt = $req->get('value');
        $donhang = Donhang::where('tttt', $tttt)->get();
        $khachhang = Khachhang::all();
        $output = '<thead>
            <tr align="center">
                <th style="width: 30px">ID</th>
                <th>Khách hàng</th>
                <th>Ngày đặt</th>
                <th>Tổng tiền</th>
                <th>Hình thức thanh toán</th>
                <th>Trạng thái thanh toán</th>
                <th>Lời nhắn</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>';
        foreach($donhang as $dh){
            $output .= '<tr class="odd gradeX" style="text-align: center">
            <td><a href="donhang/chitietdonhang/'.$dh->madh.'" >'.$dh->madh.'</a></td>';
            foreach($khachhang as $kh)
                if($dh->makh == $kh->makh)
                {
                    $output .= '<td>'.$kh->hoten.'</td>';
                    break;
                }
            $output .= '<td>'.$dh->ngaydat.'</td><td>'.$dh->tongtien.' VND</td><td>'.$dh->httt.'</td>';
            if($dh->tttt == 0)
                $output .= '<td class="alert alert-danger">Chưa thanh toán</td>';
            else
                $output .= '<td class="alert alert-success">Đã thanh toán</td>';
            if($dh->ghichu == null)
                $output .= '<td>Không có</td>';
            else 
                $output .= '<td>'.$dh->ghichu.'</td>';
            $output .= '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="#" onclick="return ConfirmDelete()">Xóa</a></td></tr>';
        }
        $output .= '</tbody>';
        echo $output;
    }

    public function getKhachhang(Request $req){
        if ($req->value == 0)
            $khachhang = DB::table('khachhang')->leftJoin('users', 'khachhang.matk', '=', 'users.id')
                    ->select('makh', 'hoten', 'diachi', 'gioitinh', 'sodt', 'khachhang.email', 'tentk')->get();
        else if($req->value == 1)
            $khachhang = DB::table('khachhang')->join('users', 'khachhang.matk', '=', 'users.id')->get();
        else if($req->value == 2)
            $khachhang = Khachhang::where('matk', null)->get();
        $output = '<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr align="center">
                            <th style="width: 30px">ID</th>
                            <th>Tên khách hàng</th>
                            <th>Giới tính</th>
                            <th>Dịa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Tên tài khoản</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach($khachhang as $kh){
            $output .=  '<tr class="odd gradeX" style="text-align: center">
                    <td>'.$kh->makh.'</td>
                    <td>'.$kh->hoten.'</td>
                    <td>'.$kh->gioitinh.'</td>
                    <td>'.$kh->diachi.'</td>
                    <td>'.$kh->sodt.'</td>
                    <td>'.$kh->email.'</td>';
                if($kh->tentk == null)
                    $output .= '<td>Không có</td>';
                else
                    $output .=   '<td>'.$kh->tentk.'</td>';
            $output .= '<td class="center"><i class="fa fa-trash-o  fa-fw">
                    </i><a href="#" onclick="return ConfirmDelete()">Xóa</a></td></tr>';     
        }
        $output .= '</tbody></table>';
        echo $output;
    }
}
