<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{

    public function detail($username)
    {
        if (Session::get('username')) {
            $from = Users::where('username', Session::get('username'))->first();
            $to = Users::where('username', $username)->first();
            if ($from && $to) {
                if ($from == $to) {
                    $messages = Messages::where('to', $to->username)->get()->all();
                } else {
                    $messages = Messages::where('to', $to->username)->where('from', $from->username)->get()->all();
                    $messages = array_merge($messages, Messages::where('to', $from->username)->where('from', $to->username)->get()->all());
                    usort($messages, function ($a, $b) {
                        return strcmp($a->time, $b->time);
                    });
                }
                $data = $to;
                return view('message.view', compact('data', 'messages'));
            }
        }

        return redirect()->route('index');
    }

    public function sendmessage($username, Request $request)
    {
        if (Session::get('username')) {
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
        }
        return redirect()->back();
    }

    public function view()
    {
        if(Session::get('username')){
            return $this->detail(Session::get('username'));
        }
        return redirect()->route('index');  
    }
}
