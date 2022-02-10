<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    public function add(Request $request)
    {
        if ($request->has('content')) {
            $data = [
                'username' => Session::get('username'),
                'content' => $request->content,
            ];
            Tasks::create($data);
        }

        if ($request->has('finish')) {
            $task = Tasks::where('id', $request->finish)->first();
            $current_date = now();
            $task->update(['finish_time' => $current_date]);
            $task->update(['status' => 1]);
        }

        if ($request->has('delete')) {
            $task = Tasks::where('id', $request->delete)->first();
            $task->update(['status' => 2]);
        }

        return back();
    }
}
