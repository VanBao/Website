<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
use App\Admin;
class AdminController extends Controller
{
    public function showLogin()
    {
    	return view("admin.login");
    }
    public function login(Request $request)
    {
    	if(Auth::guard("admin")->attempt(["email"=>$request->input("email"), "password"=>$request->input("password")]))
    	{
    		return redirect()->route("adminHome");
    	}
    	else
    	{
    		Session::flash("messageFailed", "Thông tin đăng nhập không hợp lệ. Vui lòng kiểm tra lại");
    		return redirect()->back(); 
    	}
    }
    public function logout()
    {
        Auth::guard("admin")->logout();
        return redirect()->route("loginAdmin");
    }
    public function index()
    {
        $staffs = Admin::paginate(10);
        return view("admin.pages.staff-list", ['staffs'=>$staffs]);
    }
    public function delete($id)
    {
        $admin = Admin::where("id", $id)->first();
        $admin->delete();
        return redirect()->route("listStaff");
    }
    public function create()
    {
        return view("admin.pages.staff-adding");
    }
    public function store(Request $request)
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
        $admin = new Admin;
        $admin->name = $request->input("name");
        $admin->email = $request->input("email");
        $admin->phone_number = $request->input("phoneNumber");
        $admin->address = $request->input("address");
        $admin->password = bcrypt($request->input("password"));
        $admin->gender = intval($request->input("gender"));
        $admin->level = intval($request->input("level"));
        $admin->save();
        return redirect()->route("listStaff");
    }
    public function showAccount()
    {
        return view("admin.pages.account");
    }
    public function updateAccount(Request $request)
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
        $admin = Auth::guard("admin")->user();
        $admin->name = $request->input("name");
        $admin->address = $request->input("address");
        $admin->phone_number = $request->input("phonenumber");
        $admin->gender = intval($request->input("gender"));
        $admin->save();
        return redirect()->route("accountAdmin");
    }
    public function showChangingPasswordForm()
    {
        return view("admin.pages.change-password");
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
        $admin = Auth::guard("admin")->user();
        $admin->password = bcrypt($request->input("password"));
        $admin->save();
        return redirect()->route("adminHome");
    }
    public function showPrivilege($id)
    {
        $staff = Admin::findOrFail($id);
        return view("admin.pages.privilege", ['staff'=>$staff]);
    }
    public function privilege(Request $request)
    {
        $staff = Admin::findOrFail(intval($request->input("id")));
        $staff->level = intval($request->input("level"));
        $staff->save();
        return redirect()->route("listStaff");
    }
}
