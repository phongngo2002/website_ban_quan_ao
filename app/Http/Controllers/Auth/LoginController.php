<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class LoginController extends Controller
{
    //

    public function getLogin(){
        return view('auth.index',[]);
    }

    public function postLogin(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $messages = [
          'email.required' => 'Email không được để trống',
            'email.email' => 'Bạn nhập chưa đúng định dạng email',
            'password.required' => 'Mật khẩu không được để trống'
        ];

        $validators = Validator::make($request->all(),$rules,$messages);

        if($validators->fails()){
            return redirect('login')->withErrors($validators)->withInput();
        }
        $email = $request->input('email');
        $password = $request->input('password');
        if(Auth::attempt(['email' => $email , 'password' => $password])){
            Session::flash('success','Đăng nhập thành công');
            return redirect('admin/dashboard');
        }
            Session::flash('error','Tài khoản hoặc mật khẩu không chính xác');
            return redirect('login');
    }

    public function logout(){
        Auth::logout();

        return redirect('login');
    }
}
