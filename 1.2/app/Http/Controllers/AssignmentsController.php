<?php

namespace App\Http\Controllers;

use App\Models\Assignments;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AssignmentsController extends BaseController
{
    public function index(Request $request)
    {
        if (Session::get('username')) {
            $list = Assignments::all();
            return view('assignment.index', compact('list'));
        }
        return redirect()->route('index');
    }

    public function createpage()
    {
        if (Session::get('role') == 1) {
            return view('assignment.create');
        }
        return redirect()->route('assignments');
    }

    public function create(Request $request)
    {
        if (Session::get('role') == 1) {
            $assignmentfile = $request->file('assignmentfile');
            $filename = $assignmentfile->getClientOriginalName();
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if ((Storage::exists('assignments/' . $filename))) {
                $filename = substr($filename, 0, strlen($filename) - strlen($ext) - 1);
                $i = 1;
                while (Storage::exists('assignments/' . $filename . "(" . $i . ")." . $ext)) {
                    $i = $i + 1;
                }
                $filename =  $filename . "(" . $i . ")." . $ext;
            }
            

            if (!$request->hasFile('assignmentfile')) {
                return redirect()->back()->with([
                    'message' => 'Ban chua chon file!',
                ]);
            }
            $assignmentfile = $request->file('assignmentfile');
            $assignmentfile->storeAs('assignments', $filename, 'local');
            $data = [
                
                'Description' => $request->description,
                'Deadline' => $request->deadline,
                'filename' => $filename,
            ];
            Assignments::create($data);
        }
        return redirect()->route('assignments');
    }

    public function delete($id){
        if (Session::get('role') == 1) {
            $assignment = Assignments::where('id', $id)->first();
            if($assignment){
                Storage::delete('assignments/'.$assignment->filename);
                $assignment->delete();
            }
        }
        return redirect()->route('assignments');
    }

    public function downloadfile($filename)
    {
        if (Session::get('username')) {
            return Storage::download('assignments/' . $filename);
        }
        return redirect()->route('assignments');
    }

    
}
