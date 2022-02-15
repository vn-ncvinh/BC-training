<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{


    public function loginpage(Request $request)
    {
        if ($request->session()->has('username')) {
            return redirect()->route('index');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $user = Users::where('username', $request->username)->first();
        if ($user) {
            if ($password == $user->password) {
                $request->session()->regenerate();
                $request->session()->put('username', $username);
                $request->session()->put('role', $user->role);
                return redirect()->route('index');
            }
        }

        return redirect()->back()->with([
            'message' => 'Đăng nhập thất bại!',
        ]);
    }


    public function logout()
    {
        Session::flush();
        return redirect()->route('index');
    }


    public function createpage(Request $request)
    {
        if (Session::get('role') == 1) {
            return view('user.create');
        }
        return redirect()->route('index');
    }

    public function create(Request $request)
    {
        if (Session::get('role') == 1) {
            if ($request->has('username') && $request->has('fullname') && $request->has('password') && $request->has('password2') && $request->has('email') && $request->has('phonenumber') && $request->has('role')) {
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
                            'email' => ['required'],
                            'phonenumber' => ['required'],
                            'role' => ['required'],
                            'password' => ['required'],
                        ]);
                        $user = Users::create($data);
                        return redirect()->route('index');
                    }
                }
                return redirect()->back()->with([
                    'message' => 'Hai mật khẩu không khớp nhau!',
                ]);
            }
        }
        return redirect()->back();
    }

    public function updatepage($username)
    {
        if (Session::get('role') == 1 || Session::get('username') == $username) {
            $data = Users::where('username', $username)->first();
            if ($data) {
                return view('user.update', compact('data'));
            }
        }
        return redirect()->route('index');
    }

    public function update(Request $request, $username)
    {
        if (Session::get('role') == 1 || Session::get('username') == $username) {
            $user = Users::where('username', $username)->first();
            $data = $request->validate([
                'fullname' => ['required'],
                'email' => ['required'],
                'phonenumber' => ['required'],
                'role' => ['required'],
                'password' => ['required'],
            ]);
            if ($user) {
                if($request->password != $user->password && $username == Session::get('username')){
                    $user->update($data);
                    return redirect()->route('logout');
                }
                $user->update($data);
            }
            
            
        }
        return redirect()->back()->with([
            'message' => 'Thanh cong!',
        ]);
    }


    public function delete($username)
    {
        if (Session::get('role') == 1) {
            $user = Users::where('username', $username)->first();
            if ($user) {
                $user->delete();
                if ($username == Session::get('username')) {
                    return redirect()->route('logout');
                }
                return redirect()->route('index');
            }
        }
        return redirect()->route('index');
    }
}
