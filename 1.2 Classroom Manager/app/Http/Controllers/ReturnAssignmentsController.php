<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Assignments;
use App\Models\ReturnAssignments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ReturnAssignmentsController extends Controller
{
    public function route($id)
    {
        if (Controller::check()) {
            if (Controller::checkrole()) {
                return $this->teacherpage($id);
            }
            return $this->studentpage($id);
        }
        return redirect()->route('index');
    }

    public function teacherpage($id)
    {
        $list = DB::table('return_assignments')
            ->join('users', 'return_assignments.username', '=', 'users.username')
            ->select('return_assignments.*', 'users.fullname')
            ->where('assignmentid', '=', $id)
            ->get();
        $assignment = Assignments::where('id', $id)->first();
        return view('returnassignment.view', compact('list', 'assignment'));
    }

    public function studentpage($id)
    {
        $assignment = Assignments::where('id', $id)->first();
        $turnin = ReturnAssignments::where('assignmentid', $id)->where('username', Session::get('username'))->first();
        return view('returnassignment.turnin', compact('assignment', 'turnin'));
    }

    public function turnin($id, Request $request)
    {
        if (Controller::check()) {
            $username = Session::get('username');
            if (!$request->hasFile('turninfile')) {
                return redirect()->route('turninpage', $id)->with([
                    'message' => 'Ban chua chon file!',
                ]);
            }
            $assignment = Assignments::where('id', $id)->first();
            if ($assignment->deadline > Carbon::now()) {
                $turninfile = $request->file('turninfile');
                $filename = $turninfile->getClientOriginalName();
                $turninfile->storeAs('turnin/' . $id . '/' . $username, $filename, 'local');
                $data = [
                    'username' => $username,
                    'assignmentid' => $id,
                    'filename' => $filename
                ];
                ReturnAssignments::create($data);
            } else {
                return redirect()->route('turninpage', $id)->with([
                    'message' => 'Due!',
                ]);;
            }
        }
        return redirect()->route('turninpage', $id);
    }

    public function downloadfile($id, $username, Request $request)
    {
        if (Controller::check()) {
            if (Session::get('username') == $username || Controller::checkrole()) {
                $turinwork = ReturnAssignments::where('assignmentid', $id)->where('username', $username)->first();
                if ($turinwork) {
                    return Storage::download('turnin/' . $id . '/' . $username . '/' . $turinwork->filename);
                }
            }
        }
        return redirect()->route('turninpage', $id);
    }

    public function undoturnin($id, Request $request)
    {   
        if (Controller::check()) {
            $assignment = Assignments::where('id', $id)->first();
            if ($assignment) {
                if ($assignment->deadline > Carbon::now()) {
                    $username = Session::get('username');
                    $turinwork = ReturnAssignments::where('assignmentid', $id)->where('username', $username)->first();
                    if ($turinwork) {
                        Storage::delete('turnin/' . $id . '/' . $username . '/' . $turinwork->filename);
                        $turinwork->delete();
                    }
                } else {
                    return redirect()->route('turninpage', $id)->with([
                        'message' => 'Due!',
                    ]);
                }
            }
        }
        return redirect()->route('turninpage', $id);
    }
}
