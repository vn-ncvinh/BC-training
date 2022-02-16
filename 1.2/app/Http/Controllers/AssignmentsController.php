<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Assignments;
use App\Models\ReturnAssignments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssignmentsController extends Controller
{
    public function indexpage(Request $request)
    {
        if (Controller::check()) {
            $list = Assignments::all();
            return view('assignment.index', compact('list'));
        }
        return redirect()->route('index');
    }

    public function createpage()
    {
        if (Controller::checkrole()) {
            return view('assignment.create');
        }
        return redirect()->route('assignments');
    }

    public function create(Request $request)
    {
        if (Controller::checkrole()) {


            if (!$request->hasFile('assignmentfile')) {
                return redirect()->back()->with([
                    'message' => 'Ban chua chon file!',
                ]);
            }
            $assignmentfile = $request->file('assignmentfile');
            $filename = Controller::selectFilename($assignmentfile->getClientOriginalName(), 'assignments/');

            $assignmentfile->storeAs('assignments', $filename, 'local');
            $data = [

                'description' => $request->description,
                'deadline' => $request->deadline,
                'filename' => $filename,
            ];
            Assignments::create($data);
        }
        return redirect()->route('assignments');
    }

    public function delete($id)
    {
        if (Controller::checkrole()) {
            $assignment = Assignments::where('id', $id)->first();
            if ($assignment) {
                $turnins = ReturnAssignments::where('assignmentid', $id)->delete();
                Storage::deleteDirectory('turnin/' . $id);
                Storage::delete('assignments/' . $assignment->filename);
                $assignment->delete();
            }
        }
        return redirect()->route('assignments');
    }

    public function downloadfile($id)
    {
        if (Controller::check()) {
            $assignment = Assignments::where('id', $id)->first();
            return Storage::download('assignments/' . $assignment->filename);
        }
        return redirect()->route('assignments');
    }

    public function updateFile(Request $request, $id)
    {
        if (Controller::checkrole()) {
            if (!$request->hasFile('assignmentfile')) {
                return redirect()->back()->with([
                    'message' => 'Ban chua chon file!',
                ]);
            }
            $assignment = Assignments::where('id', $id)->first();
            $filename = $assignment->filename;
            if ($assignment) {
                Storage::delete('assignments/' . $filename);
            }

            $assignmentfile = $request->file('assignmentfile');
            $filename = Controller::selectFilename($assignmentfile->getClientOriginalName(), 'assignments/');
            $data = [
                'filename' => $filename
            ];
            $assignment->update($data);
            $assignmentfile->storeAs('assignments', $filename, 'local');
        }
        return redirect()->back();
    }
}
