<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Khachhang;
use App\Sanpham;
use App\Donhang;
use App\Loaisanpham;
use App\Phanhoi;
use App\Cthd;
use App\Hoadon;

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
            $output .= '<td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="javascript:void(0)" onclick="ConfirmDelete('.$dh->madh.','.$dh->tttt.')">Xóa</a></td></tr>';
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
        }
        $output .= '</tbody></table>';
        echo $output;
    }

    public function getPhanhoi(Request $req){
        $content = Phanhoi::where('maph', $req->maph)->first();
        $output = '
                        <div class="row">
                            <div>
                                <div class="well form-horizontal">
                                    <h2>Thông tin khách hàng</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Vấn đề</label>
                                        <div class="col-md-8">
                                            <input type="text" name="Title" class="form-control" value="'.$content->vande.'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ngày phản hồi</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="CreatedDate" value="'.$content->ngayph.'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tên khách hàng</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="Name" value="'.$content->hoten.'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="Email" value="'.$content->email.'">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Địa chỉ</label>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="Address" value="'.$content->diachi.'">
                                        </div>
                                    </div>
                    
                                    <h2>Nội dung phản hồi</h2>
                                    <hr>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Nội dung</label>
                                        <br>
                                            '.$content->noidung.'
                                    </div>
                                </div>
                            </div>
                        </div>';
        echo $output;     
    }

    public function getChitiethoadon(Request $req){
        $cthd = Cthd::where('mahd', $req->mahd)->get();
        $sanpham = [];
        foreach($cthd as $ct){
            $temp = Sanpham::where('masp', $ct->masp)->first();
            array_push($sanpham, $temp);
        }
        $khachhang = DB::table('khachhang')->join('hoadon', 'khachhang.makh', '=', 'hoadon.makh')
                        ->where('hoadon.mahd', '=', $req->mahd)->first();
        $output = '<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Chi tiết hóa đơn</h1>
                            <div id="thongbao" >
                            </div>  
                        </div>
                        <div class="widget-body no-padding" style="border: 1px">
                            <div class="widget-body-toolbar">
                            </div>
            
                            <div class="padding-10">
                                <br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Hình ảnh</th>
                                            <th class="text-center">Số lượng</th>
                                            <th>Đơn giá</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>';

                                        foreach($cthd as $ct){
                                        $output .= '
                                        <tr ng-repeat="item in OrderDetails" class="ng-scope">
                                            <td>';
                                                foreach($sanpham as $sp)
                                                if($sp->masp == $ct->masp){
                                                $output .= '<a href="javascript:void(0)" target="_blank" class="ng-binding">'.$sp->tensp.'</a>
                                                    
                                            </td>
                                            <td><img src="product/'.$sp->hinhanh.'" class="img-responsive" style="height:40px;" ></td>';
                                                break;
                                            }
                                            $output .= '
                                            <td class="text-center"><strong class="ng-binding">'.$ct->soluong.'</strong></td>
                                            <td class="ng-binding">'.$ct->gia.' VND</td>
                                            <td class="text-right ng-binding">'.$ct->soluong * $ct->gia.' VND</td>
                                        </tr>';
                                        }
                                    $output .= '
                                    </tbody>
                                    <tbody class="order-totals-summary">
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td class="text-right">Tổng giá trị sản phẩm:</td>
                                            <td class="text-right">
                                                <span class="ng-binding">'.$khachhang->tongtien.' VND</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right" colspan="4">Số tiền phải thanh toán:</td>
                                            <td class="text-right">
                                                <span class="ng-binding">'.$khachhang->tongtien.'</span>
                                                <span>VND</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="invoice-footer">
            
                                    <div class="row">
            
                                        <div class="col-sm-7">
                                            <div class="payment-methods">
                                                <h5>Phương thức thanh toán</h5>
                                                <h3><strong><span class="text-success ng-binding">'.$khachhang->httt.'</span></strong></h3>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="invoice-sum-total pull-right">
                                                <h3><strong>Thanh toán: <span class="text-success ng-binding">'.$khachhang->tongtien.' VND</span></strong></h3>
                                            </div>
                                        </div>
            
                                    </div>
            
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p class="note ng-binding"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>';
        echo $output;
    }

    public function getDoanhthutheohoadon(Request $req){

        if($req->value == 1) {
            $hoadon = DB::table('hoadon')->where('ngaythanhtoan', $req->date)->get();
            $tong = 0;
            $stt = 0;
            $output = '<table class="table table-hover">
            <thead>
              <tr>
                <th>STT</th>
                <th>Ngày thanh toán</th>
                <th>Hình thức thanh toán</th>
                <th>Tổng tiền</th>
              </tr>
            </thead>
            <tbody>';
            foreach($hoadon as $hd){
                $stt++;
                $tong += $hd->tongtien;
                $output .= '<tr>
                    <td>'.$stt.'</td>
                    <td>'.$hd->ngaythanhtoan.'</td>
                    <td>'.$hd->httt.'</td>
                    <td>'.$hd->tongtien.' VNĐ</td>
                </tr>';
            }
            $output .= '<tr style="font-weight: bold">
                    <td>Tổng doanh thu: </td>
                    <td colspan="3" >'.$tong.' VNĐ</td>
                </tr>';
            $output .= '</tbody></table>';
            echo $output;
        }
        else if($req->value == 2){
            $hoadon = DB::table('hoadon')->select(DB::raw("year(ngaythanhtoan) as nam"), DB::raw("month(ngaythanhtoan)  as thang"), DB::raw("SUM(tongtien) as tongtien"), 'httt')
                                        ->whereBetween('ngaythanhtoan', [$req->date['batdau'], $req->date['ketthuc']])
                                        ->groupBy(DB::raw("year(ngaythanhtoan)"), DB::raw("month(ngaythanhtoan)"), 'httt')
                                        ->get();
            $tong = 0;
            $stt = 0;
            $output = '<table class="table table-hover">
            <thead>
                <tr>
                <th>STT</th>
                <th>Tháng</th>
                <th>Năm</th>
                <th>Hình thức thanh toán</th>
                <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>';
            foreach($hoadon as $hd){
                $stt++;
                $tong += $hd->tongtien;
                $output .= '<tr>
                    <td>'.$stt.'</td>
                    <td>'.$hd->thang.'</td>
                    <td>'.$hd->nam.'</td>
                    <td>'.$hd->httt.'</td>
                    <td>'.$hd->tongtien.' VNĐ</td>
                </tr>';
            }
            $output .= '<tr style="font-weight: bold">
                    <td>Tổng doanh thu: </td>
                    <td colspan="3" >'.$tong.' VNĐ</td>
                </tr>';
            $output .= '</tbody></table>';
            echo $output;     
        }
        else if($req->value == 3){
            $hoadon = DB::table('hoadon')->select(DB::raw("year(ngaythanhtoan) as nam"), DB::raw("SUM(tongtien) as tongtien"), 'httt')
                                        ->whereBetween('ngaythanhtoan', [$req->date['batdau'], $req->date['ketthuc']])
                                        ->groupBy(DB::raw("year(ngaythanhtoan)"), 'httt')
                                        ->get();
            $tong = 0;
            $stt = 0;
            $output = '<table class="table table-hover">
            <thead>
                <tr>
                <th>STT</th>
                <th>Năm</th>
                <th>Hình thức thanh toán</th>
                <th>Tổng tiền</th>
                </tr>
            </thead>
            <tbody>';
            foreach($hoadon as $hd){
                $stt++;
                $tong += $hd->tongtien;
                $output .= '<tr>
                    <td>'.$stt.'</td>
                    <td>'.$hd->nam.'</td>
                    <td>'.$hd->httt.'</td>
                    <td>'.$hd->tongtien.' VNĐ</td>
                </tr>';
            }
            $output .= '<tr style="font-weight: bold">
                    <td>Tổng doanh thu: </td>
                    <td colspan="3" >'.$tong.' VNĐ</td>
                </tr>';
            $output .= '</tbody></table>';
            echo $output;         
        }
    }
}
