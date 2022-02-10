<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{


    public function loginpage(Request $request)
    {   
        if ($request->session()->has('username')) {
            return redirect()->route('index');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = Users::where('username', $request->username)->first();
        if($user){
            if ($password == $user->password){
                $request->session()->regenerate();
                $request->session()->put('username', $username);
                return redirect()->route('index');
            }
        }

        return redirect()->back()->with([
            'message' => 'Đăng nhập thất bại!',
        ]);
    }

    public function createpage(Request $request)
    {   
        if ($request->session()->has('username')) {
            return redirect()->route('index');
        }
        return view('create');
    }

    public function create(Request $request)
    {
        if($request->has('username') && $request->has('fullname') && $request->has('password') && $request->has('password2')){
            if ($request->password == $request->password2) {
                $user = Users::where('username', $request->username)->first();
                if ($user) {
                    return redirect()->back()->with([
                        'message' => 'Người dùng đã tồn tại!',
                    ]);
                } else {
                    $data = $request->validate([
                        'username' => ['required'],
                        'fullname' => ['required'],
                        'password' => ['required'],
                    ]);
                    Users::create($data);
                    $request->session()->regenerate();
                    $request->session()->put('username', $request->username);
                    return redirect()->route('index');
                }
            }
            return redirect()->back()->with([
                'message' => 'Hai mật khẩu không khớp nhau!',
            ]);
        }
        return redirect()->back();
        
    }
}
