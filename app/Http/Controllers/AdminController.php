<?php

namespace App\Http\Controllers;
use App\Khachhang;
use App\Donhang;
use App\Sanpham;
use App\Loaisanpham;
use App\Hoadon;
use App\Ctdh;
use App\Cthd;
use App\Dknt;
use App\Phanhoi;
use Carbon\Traits\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Broadcasting\Broadcasters\PusherBroadcaster;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Caster\LinkStub;

class AdminController extends Controller
{

    public function getTrangchu(){
        $date = date('Y-m-d');
        $donhangmoi = Donhang::where('ngaydat', '=', $date, 'AND', 'tttt', '=', 0)->get();
        $phanhoimoi = Phanhoi::where('ngayph', '=', $date)->get();
        $dkntmoi = Dknt::where('ngaydk', '=', $date)->get();
        return view('admin.index', compact('donhangmoi', 'phanhoimoi', 'dkntmoi'));
    }

    //Nhóm Controller sản phẩm

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
        $check = Ctdh::where('masp', $masp)->first();
        if(is_null($check)){
            DB::table('Cthd')->where('masp', '=' , $masp)->update(['masp' => null]);
            DB::table('sanpham')->where('masp', '=', $masp)->delete();
            return redirect()->back()->with(['thanhcong' => 'Xóa sản phẩm thành công']);
        }
        else 
        return redirect()->back()->with(['loi' => 'Sản phẩm còn đang được đặt hàng, không thể xóa']);
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

    //Nhóm Controller loại sản phẩm

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
        $loaisp = Loaisanpham::where('tenloaisp', $req->tenloaisp)->first();
        if($loaisp == null) return redirect()->back()->with(['loi' => 'Loại sản phẩm đã tồn tại trong hệ thống']);
        else
            DB::table('loaisanpham')->insert(['tenloaisp' => $req->tenloaisp]);
        return redirect()->back()->with(['thanhcong' => 'Thêm loại sản phẩm thành công']);
    }

    public function getXoaloaisanpham($maloaisp){
        $sanpham = Sanpham::where('maloaisp', $maloaisp)->first();
        if(is_null($sanpham)){
            DB::table('loaisanpham')->where('maloaisp', '=', $maloaisp)->delete();
            return redirect()->back()->with(['thanhcong' => 'Xóa loại sản phẩm thành công']);
        }
        else{
            return redirect()->back()->with(['loi' => 'Sản phẩm còn đang được sử dụng, vui lòng xóa các sản phẩm con trước']);
        }
    }

    public function getSualoaisanpham($maloaisp){
        $loaisanpham = Loaisanpham::where('maloaisp', $maloaisp)->first();
        return view('admin.loaisanpham.sualoaisanpham', compact('loaisanpham'));
    }

    public function postSualoaisanpham(Request $req){
        DB::table('loaisanpham')->where('maloaisp', '=', $req->maloaisp)
                                ->update(['tenloaisp'=>$req->tenloaisp]);
        return redirect()->back()->with(['thanhcong'=>'Sủa loại sản phẩm thành công']);
    }

    //Nhóm Controller đơn hàng
    public function getDonhang(){
        // $donhang = Donhang::where('tttt', 0)->get();
        $donhang = Donhang::all();
        $khachhang = [];
        foreach($donhang as $dh){
            $temp = Khachhang::where('makh', $dh->makh)->first();
            array_push($khachhang, $temp);
        }
        return view('admin.donhang.danhsachdonhang', compact('donhang', 'khachhang'));
    }

    public function getXoadonhang($madh, $tttt){
        if($tttt == 0){
            DB::table('ctdh')->where('madh', '=', $madh)->delete();
            DB::table('donhang')->where('madh', '=', $madh, 'AND', 'tttt', '=', $tttt)->delete();
            return redirect()->back()->with(['thanhcong'=>'Xóa đơn hàng thành công']);
        }
        else
            return redirect()->back()->with(['loi'=>'Đơn hàng đã thanh toán, không thể xóa']);
    }

    public function getChitietdonhang($madh){
        $ctdh = Ctdh::where('madh', $madh)->get();
        $sanpham = [];
        foreach($ctdh as $ct){
            $temp = Sanpham::where('masp', $ct->masp)->first();
            array_push($sanpham, $temp);
        }
        $khachhang = DB::table('khachhang')->join('donhang', 'khachhang.makh', '=', 'donhang.makh')
                        ->where('donhang.madh', '=', $madh)->first();
        return view('admin.donhang.chitietdonhang', compact('ctdh', 'khachhang', 'sanpham'));
    }

    public function getDonhangmoi(){
        $date = date('Y-m-d');
        $donhangmoi = DB::table('khachhang')->join('donhang', 'khachhang.makh', '=', 'donhang.makh')
        ->where('ngaydat', '=', $date)->get();
        return view('admin.donhang.donhangmoi', compact('donhangmoi'));
    }

    public function getThanhtoan(Request $req){
        $ctdh = Ctdh::where('madh', $req->madh)->get();
        $donhang = Donhang::where('madh', $req->madh)->first();
        $hoadon = new Hoadon();
        $hoadon->makh = $donhang->makh;
        $hoadon->ngaythanhtoan = date('Y-m-d');
        $hoadon->tongtien = $donhang->tongtien;
        $hoadon->httt = $donhang->httt;
        $hoadon->save();
        DB::table('donhang')->where('madh', '=', $req->madh)->update(['tttt' => 1]);
        foreach($ctdh as $ct){
            $cthd = new Cthd();
            $cthd->mahd = $hoadon->id;
            $cthd->masp = $ct->masp;
            $cthd->soluong = $ct->soluong;
            $cthd->gia = $ct->gia;
            $cthd->save();
        }
        return redirect()->back()->with(['thanhcong', 'Xác nhận thanh toán thành công']);
    }

    //Nhóm controller thống kê
    public function getThongke(){
        $nam = DB::table('hoadon')->select(DB::raw('year(ngaythanhtoan) as nam'))
                            ->groupBy(DB::raw('year(ngaythanhtoan)'))
                            ->get();
        return view('admin.thongke.thongkedoanhthu', compact('nam'));
    }

    public function getThongketheohoadon(){
        return view('admin.thongke.thongketheohoadon');
    }

    //Nhóm controller khách hàng
    public function getKhachhang(){
        $khachhang = DB::table('khachhang')->leftJoin('users', 'khachhang.matk', '=', 'users.id')
                    ->select('makh', 'hoten', 'diachi', 'gioitinh', 'sodt', 'khachhang.email', 'tentk')->get();
        return view('admin.khachhang.danhsachkhachhang', compact('khachhang'));
    }

    public function getDangkinhantin(){
        $dknt = Dknt::all();
        return view('admin.khachhang.dangkinhantin', compact('dknt'));
    }

    public function getDangkinhantinmoi(){
        $date = date('Y-m-d');
        $dknt = Dknt::where('ngaydk', $date)->get();
        return view('admin.khachhang.dangkinhantin', compact('dknt'));
    }

    //Nhóm controller phản hồi
    public function getPhanhoi(){
        $phanhoi = Phanhoi::getAll();
        return view('admin.phanhoi.danhsachphanhoi', compact('phanhoi'));
    }

    public function getPhanhoimoi(){
        $date = date('Y-m-d');
        $phanhoi = Phanhoi::where('ngayph', $date)->get();
        return view('admin.phanhoi.phanhoimoi', compact('phanhoi'));
    }

    public function getXoaphanhoi($maph){
        if(Phanhoi::xoaphanhoi($maph))
        return redirect()->back()->with(['thanhcong'=>'Xóa phản hồi thành công']);
    }

    //Nhóm controller hóa đơn
    public function getHoadon(){
        $hoadon = Hoadon::all();
        $khachhang = [];
        foreach($hoadon as $dh){
            $temp = Khachhang::where('makh', $dh->makh)->first();
            array_push($khachhang, $temp);
        }
        return view('admin.hoadon.danhsachhoadon', compact('hoadon', 'khachhang'));
    }

    public function getChitiethoadon($mahd){
        $cthd = Cthd::where('mahd', $mahd)->get();
        $sanpham = [];
        foreach($cthd as $ct){
            $temp = Sanpham::where('masp', $ct->masp)->first();
            array_push($sanpham, $temp);
        }
        $khachhang = DB::table('khachhang')->join('hoadon', 'khachhang.makh', '=', 'hoadon.makh')
                        ->where('hoadon.mahd', '=', $mahd)->first();
        return view('admin.hoadon.chitiethoadon', compact('cthd', 'khachhang', 'sanpham'));
    }
}
