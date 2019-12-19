<?php

namespace App\Http\Controllers;

use App\User;
use App\Quyen;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Reminder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function getDangnhap(){
    	return view('admin.dangnhap');
    }

    public function getQuenmatkhau(){
    	return view('admin.quenmatkhau');
	}
	
	public function getKhoiphuc($email, $code){ 
		return view('admin.khoiphuc', compact('email', 'code'));
    }

    public function getDangxuat(){
        DB::table('users')->where('email', Auth::user()->email)
                                ->update(['ttdn' => 0]);
        Auth::logout();
        return redirect()->route('dang-nhap');
    }

	public function postDangnhap(Request $req){
		$this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 20 kí tự'
            ]
        );
        $dangnhap = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($dangnhap)){
            DB::table('users')->where('email', $req->email)
                                ->update(['ttdn' => 1]);
            return redirect()->route('trang-chu');
        }
        else{
            return redirect()->back()->with(['message'=>'Thông tin email hoặc mật khẩu không chính xác']);
        }
	}

	public function postKhoiphuc(Request $req){
		$this->validate($req,
            [
                'password'=>'required|min:6|max:20',
                're_password'=>'required|same:password'
            ],
            [
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
			]);
			
		$password = Hash::make($req->password);

		DB::table('users')
            ->where('email', $req->email)
			->update(['password' => $password]);

		DB::table('reminders')->where('code', '=', $req->code)->delete();
		
		return redirect()->route('dang-nhap')->with(['thanhcong' => 'Khôi phục tài khoản thành công']);
	}

    public function postQuenmatkhau(Request $req){
    	$user = User::whereEmail($req->email)->first();
    	
    	if(!$user){
    		return redirect()->back()->with(['loi' => 'Email không tồn tại trong hệ thống']);
    	}
    	$user = Sentinel::findById($user->id);
    	$reminder = Reminder::exists($user) ?  : Reminder::create($user);
    	$this->sendEmail($user, $reminder->code);

    	return redirect()->back()->with(['thanhcong' => 'Code phục hồi đã gửi đến email của bạn']);
    }

    public function sendEmail($user, $code){
    	Mail::send(
    		'admin.forgot',
    		['user'=>$user, 'code'=>$code],
    		function($message) use  ($user){
    			$message->to($user->email);
    			$message->subject("$user->email, Mã khôi phục của bạn.");
    		}		
    	);
    }

    public function getTaikhoan(){
        $taikhoan = User::all();
        $quyen = Quyen::all();
        return view('admin.taikhoan.danhsachtaikhoan', compact('taikhoan', 'quyen'));
    }

    public function getThemtaikhoan(){
        return view('admin.taikhoan.themtaikhoan');
    }

    public function postThemtaikhoan(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'tentk'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->tentk = $req->tentk;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->hinhanh = $req->hinhanh;
        $user->maquyen = $req->maquyen;
        $user->save();
        return redirect()->back()->with('thanhcong','Thêm tài khoản thành công');
    }

    public function getThongtin($id){
        $taikhoan = User::where('id', $id)->first();
        $quyen = Quyen::where('maquyen', $taikhoan->maquyen)->first();
        return view('admin.taikhoan.thongtintaikhoan', compact('taikhoan', 'quyen'));
    }

    // public function getXoataikhoan($id){
    //     $user = User::where('id', $id)->first();
    //     if($user->ttdn == 1)
    //         return redirect()->back()->with(['loi'=>'Tài khoản còn đang dùng, không thể xóa']);
    //     else
    //         DB::table('users')->where('id', '=', $id)->delete();
    //     return redirect()->back()->with(['thanhcong'=>'Xóa tài khoản thành công']);
    // }

    public function getDoimatkhau(){
        return view('admin.taikhoan.doimatkhau');
    }

    public function postDoimatkhau(Request $req){
        if(Auth::check()){
            if($req->password != $req->re_password)
                return redirect()->back()->with(['loi'=>'Xác nhận mật khẩu không giống nhau']);
            if(Hash::check($req->old_password, Auth::user()->password) == false){
                return redirect()->back()->with(['loi'=>'Mật khẩu cũ không chính xác']);
            }
            else{
                $password = Hash::make($req->password);

                DB::table('users')
                    ->where('email', Auth::user()->email)
                    ->update(['password' => $password]);
                    
                return redirect()->back()->with(['thanhcong'=>'Đổi mật khẩu thành công']);
            }
        }
        else return redirect()->back()->with(['loi'=>'Bạn chưa đăng nhập không thể thực hiện chức năng này']);
    }

    public function getSuataikhoan($matk){
        $taikhoan = User::where('id', $matk)->first();
        if($taikhoan->maquyen == 2) 
            return redirect()->back()->with(['thongbao'=>'Đây là user của khách hàng, hãy để khách hàng tự động cập nhật']);
        return view('admin.taikhoan.suataikhoan', compact('taikhoan'));
    }

    public function postSuataikhoan(Request $req){
        DB::table('users')->where('id', $req->id)
                            ->update(['tentk'=>$req->tentk, 'hinhanh'=>$req->hinhanh, 'maquyen'=>$req->maquyen]);
        return redirect()->back()->with(['thanhcong'=>'Cập nhật tài khoản thành công']);
    }
}
