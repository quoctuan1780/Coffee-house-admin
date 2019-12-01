<?php

namespace App\Http\Controllers;

use App\User;
use App\Quyen;
use Sentinel;
use Reminder;
use Mail;
use Hash;
use DB;
use Auth;

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

}
