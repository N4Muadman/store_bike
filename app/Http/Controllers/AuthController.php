<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginForm(){
        return view('pages.auth.login');
    }

    public function login(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            if(Auth::user()->isAdmin()){
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended('/')->with('success', 'Đăng nhập thành công'); 
        }

        return redirect()->back()->withErrors([
            'loginError' => 'Tên đăng nhập hoặc mật khẩu không chính xác.',
        ]);
    }

    public function registerForm(){
        return view('pages.auth.register');
    }

    public function register(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        $data['role_id'] = 2;

        User::create($data);

        return redirect()->route('login.form')->with('success', 'Đăng ký thành công');
    }

    public function logout() {
        if(!Auth::check()){
            return redirect()->route('login.form')->with('error', 'vui lòng đăng nhập trước khi đăng xuất');
        }
        Auth::logout();
        return redirect()->route('login.form')->with('success', 'Đăng xuất thành công');
    }
}
