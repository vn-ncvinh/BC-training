<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

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
        if ($request->session()->has('username')) {
            if (Session::get('role') == 1) {
                return view('create');
            }
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

    public function updatepage($id)
    {
        if (Session::get('role') == 1) {
            $data = Users::where('id', $id)->first();
            return view('update', compact('data'));
        }
        return redirect()->route('index');
    }

    public function update(Request $request, $id)
    {
        if (Session::get('role') == 1) {
            $user = Users::where('id', $id)->first();
            $data = $request->all();
            $user->update($data);
        }
        return redirect()->back()->with([
            'message' => 'Thanh cong!',
        ]);
    }


    public function delete($id)
    {
        if (Session::get('role') == 1) {
            $user = Users::where('id', $id)->first();
            if ($user) {
                if ($user->username == Session::get('username')) {
                    $user->delete();
                    return redirect()->route('logout');
                }
                $user->delete();
                return redirect()->route('index');
            }
        }
        return redirect()->route('index');
    }

    public function detail($username)
    {
        $from = Users::where('username', Session::get('username'))->first();
        $to = Users::where('username', $username)->first();
        if ($from && $to) {
            if($from == $to){
                $messages = Messages::where('to', $to->username)->get()->all();
            } else {
                $messages = Messages::where('to', $to->username)->where('from', $from->username)->get()->all();
                $messages = array_merge($messages, Messages::where('to', $from->username)->where('from', $to->username)->get()->all());
                usort($messages, function($a, $b) {return strcmp($a->time, $b->time);});
            }
            $data = $to;
            return view('detail', compact('data', 'messages'));
        }
        return redirect()->route('index');
    }

    public function sendmessage($username, Request $request)
    {
        $from = Users::where('username', Session::get('username'))->first();
        $to = Users::where('username', $username)->first();
        if ($from && $to) {
            $content = $request->content;
            $data = [
                'from' => $from->username,
                'to' => $to->username,
                'content' => $content
            ];
            Messages::create($data);
        }
        return redirect()->back();
    }

    public function view(){
        return $this->detail(Session::get('username'));
    }
}
