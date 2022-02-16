<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        if ($this->check()) {
            $list = Users::all();
            return view('index', compact('list'));
        } else {
            Session::flush();
            return redirect()->route('login');
        }
    }

    public function check(){
        if (Session::has('username')){
            $user = Users::where('username', Session::get('username'))->first();
            if($user){
                return true;
            }
        }
        return false;
    }

    public function checkrole(){
        // if (Session::has('username') && Session::has('role')){
        //     $user = Users::where('username', Session::get('username'))->first();
        //     if($user && $user->role == 1 && Session::get('role') == 1){
        //         return true;
        //     }
        // }
        // return false;
        return true;
    }

    public function selectFilename($filename, $filepatch)
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if ((Storage::exists($filepatch . $filename))) {
            $filename = substr($filename, 0, strlen($filename) - strlen($ext) - 1);
            $i = 1;
            while (Storage::exists($filepatch . $filename . "(" . $i . ")." . $ext)) {
                $i = $i + 1;
            }
            $filename =  $filename . "(" . $i . ")." . $ext;
        }
        return $filename;
    }
}
