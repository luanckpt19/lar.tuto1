<?php

namespace App\Http\Controllers;

use App\Model\ShipperModel;
use Illuminate\Http\Request;

class ShipperController extends Controller
{
    // Hàm khởi tạo của class được chạy ngay khi khởi tạo đối tượng
// Hàm này luôn được chạy trước các hàm khác trong class


    public function __Construct(){

        $this->middleware('auth:shipper')->only('index');
    }

    /*
     * Phương thức trả về view khi đăng nhập shipper thành công*/
    public function index(){
        return view('shipper.dashboard');
    }

    /*Phương thức trả về view dùng để đăng ký tài khoản shipper   */
    public function create(){
        return view('shipper.auth.register');
    }

    public  function store(Request $request){

        //validate dữ liệu được gửi từ form đi
        $this->validate($request,array(
            'name'=> 'required',
            'email' =>'required',
            'password' => 'required'
        ));

        // khởi tạo model để lưu seller mới
        $ShipperModel = new ShipperModel();
        $ShipperModel->name = $request->name;
        $ShipperModel->email = $request->email;
        $ShipperModel->password = bcrypt($request->password);
        $ShipperModel->save();

        return redirect()->route('shipper.auth.login');
    }
}
