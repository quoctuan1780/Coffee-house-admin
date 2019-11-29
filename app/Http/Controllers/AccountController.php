<?php

namespace App\Http\Controllers;

use App\User;
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
            return redirect()->route('danh-sach-san-pham');
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

}
