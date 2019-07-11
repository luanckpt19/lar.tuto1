<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /*
     * Phương thức trả về view khi đăng nhập admin thành công*/
    public function index(){
         return view('admin.dashboard');
    }

    /*Phương thức trả về view dùng để đăng ký tài khoản admin   */
    public function create(){
        return view('admin.auth.register');
    }
    public  function store(Request $request){

        //validate dữ liệu được gửi từ form đi
        $this->validate($request,array(
            'name'=> 'required',
            'email' =>'required',
            'password' => 'required'
        ));

        // khởi tạo model để lưu admin mới
        $adminModel = new AdminModel();
        $adminModel->name = $request->name;
        $adminModel->email = $request->email;
        $adminModel->password = bcrypt($request->password);
        $adminModel->save();

        return redirect()->route();
    }
}

