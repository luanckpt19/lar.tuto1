<?php

namespace App\Http\Controllers\Auth\Shipper;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function __Construct(){
        $this->middleware('guest:shipper')->except('logout');

    }
    /*
     * Phương thức này trả về view dùng để đăng nhập  cho shipper*/
    public function login(){
        return view('shipper.auth.login');

    }

    /*Phương thức này sẽ dùng để đăng nhập cho shipper
    lấy thông tin từ METHOD là POSt*/
    public function loginShipper(Request $request){

        //validate dữ liệu
        $this->validate($request,array(
            'email'=>'required|email',
            'password' => 'required|min:6'
        ));

        //Đăng nhập
        if (Auth::guard('shipper')->attempt(
            ['email'=>$request->email,'password'=>$request->password], $request->remember
        )){
            //Nếu đăng nhập thành công thì sẽ chuyển hướng về view dashboard của admin
            return redirect()->intended(route('shipper.dashboard'));

        }
        // Nếu đăng nhập thất bại thì quay trở về form đăng nhập
        // với giá trị của 2 ô input cũ là email và remember
        return redirect()->back()->withInput($request->only('email','remember'));

    }

    /*
       * Phương thức này dùng để đăng xuất*/
    public function logout(){
        Auth::guard('shipper')->logout;
        // sau khi đăng xuất sẽ chuyển về trang login
        return redirect()->route('shipper.auth.login');

    }
}
