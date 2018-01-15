<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Mail;

class UserController extends Controller
{
    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('login');
    }
    public function register(Request $request)
    {
    	$this->validate(
    		$request, 
    		[
            	'email'=>'unique:user,email',
            	'password'=>'min:8|same:password2',
            	'phonenumber'=>'digits_between:10,11'
            ], 
            [
            	'email.unique'=>'Địa chỉ email đã tồn tại',
            	'password.min'=>'Mật khẩu  phải có ít nhất 8 ký tự',
            	'password.same'=>'2 mật khẩu không trùng nhau',
            	'phonenumber.digits_between'=>'Số điện thoại không hợp lệ'
            ]
        );
        $user = new User;
        $user->name = $request->input("name");
        $user->email = $request->input("email");
        $user->phone_number = $request->input("phonenumber");
        $user->address = $request->input("address");
        $user->password = bcrypt($request->input("password"));
        $user->save();
        $data = ["name"=>$request->input("name"), "email"=>$request->input("email")];
        Mail::send('email.verify-user', $data, function($message) use($request){

            $message->to($request->input("email"));

            $message->subject("Kích hoạt tài khoản");

        });
        Session::flash("messageSuccessful", "Bạn đã đăng ký thành công. Vui lòng đăng nhập tài khoản email để kích hoạt tài khoản.");
        return redirect()->route("register");
    }
    public function login(Request $request)
    {
    	$this->validate
    	(
    		$request, 
    		[
    			"password"=>"min:8"
            ], 
            [
                "password.min"=>"Mật khẩu có ít nhất 8 ký tự"
            ]
        );
        $email = $request->input("email");
        $password = $request->input("password");
        if(Auth::attempt(["email"=>$email, "password"=>$password, 'active'=>1]))
        {
        	return redirect()->route("account");
        }
        else if(Auth::attempt(["email"=>$email, "password"=>$password]))
        {
            Session::flash("messageFailed", "Tài khoản chưa được kích hoạt. Vui lòng kiểm tra lại email.");
        }else
        {
            Session::flash("messageFailed", "Email hoặc mật khẩu không chính xác. Vui lòng kiểm tra lại");
        }
        return redirect()->route("home");
    }
    public function activate($email)
    {
        $user = User::where([['email', $email],['active', 0]])->first();
        $user->active = 1;
        $user->save();
        return redirect()->route("login");
    }
    public function changeInformation(Request $request)
    {
        $this->validate(
            $request, 
            [
                'phonenumber'=>'digits_between:10,11'
            ], 
            [
                'phonenumber.digits_between'=>'Số điện thoại không hợp lệ'
            ]
        );
        $user = Auth::user();
        $user->name = $request->input("name");
        $user->address = $request->input("address");
        $user->phone_number = $request->input("phonenumber");
        $user->save();
        return redirect()->route("account");
    }
    public function changePassword(Request $request)
    {
        $this->validate(
            $request, 
            [
                'password'=>'min:8|same:password2'
            ], 
            [
                'password.min'=>"Mật khẩu phải có ít nhất 8 ký tự",
                'password.same'=>'Hai mật khẩu không trùng nhau. Vui lòng kiểm tra lại.'
            ]
        );
        $user = Auth::user();
        $user->password = bcrypt($request->input("password"));
        $user->save();
        return redirect()->route("account");
    }
    public function resetPassword(Request $request)
    {
        $user = User::where("email", $request->input("email"))->first();
        if(!is_null($user))
        {
            $newPassword = str_random(8).time();
            $user->password = bcrypt($newPassword);
            $user->save();
            Mail::send('email.reset-password', ["user"=>$user, 'newPassword'=>$newPassword], function($message) use($request){

                $message->to($request->input("email"));

                $message->subject("Thay đổi mật khẩu");

            });
            Session::flash("messageSuccessful", "Link khôi phục mật khẩu đã được đến email của bạn. Vui lòng kiểm tra");
        }
        else
        {
            Session::flash("messageFailed", "Email không tồn tại. Vui lòng kiểm tra lại.");
        }
        return redirect()->back();
    }
}
