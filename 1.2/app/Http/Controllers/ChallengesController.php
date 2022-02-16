<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Challenges;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChallengesController extends Controller
{
    public function indexpage()
    {
        if (Controller::check()) {
            $challenges = Challenges::all();
            return view('challenge.index', compact('challenges'));
        }
        return redirect()->route('index');
    }

    public function createpage()
    {
        if (Controller::checkrole()) {
            return view('challenge.create');
        }
        return $this->indexpage();
    }


    public function create(Request $request)
    {
        if (Controller::checkrole()) {
            if (!$request->hasFile('challengefile')) {
                return redirect()->back()->with([
                    'message' => 'Ban chua chon file!',
                ]);
            }
            $challengefile = $request->file('challengefile');
            $filename = Controller::selectFilename($challengefile->getClientOriginalName(), 'challenges/');
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if(strcmp(strtoupper($ext), strtoupper('txt')) != 0){
                return redirect()->back()->with([
                    'message' => 'Only accept txt files!',
                ]);
            }
            $challengefile->storeAs('challenges', $filename, 'local');
            $data = [

                'name' => $request->name,
                'hint' => $request->hint,
                'filename' => $filename,
            ];
            Challenges::create($data);
        }
        return redirect()->route('challenges');
    }

    public function detail($id)
    {
        if (Controller::check()) {
            $challenge = Challenges::where('id', $id)->first();
            return view('challenge.detail', compact('challenge'));
        }
    }

    public function answer($id, Request $request)
    {
        if (Controller::check()) {
            if ($request->has('answer')) {
                $challenge = Challenges::where('id', $id)->first();
                if ($challenge) {
                    $filename = $challenge->filename;
                    $ext = pathinfo($filename, PATHINFO_EXTENSION);
                    $filename = substr($filename, 0, strlen($filename) - strlen($ext) - 1);
                    $sim = similar_text(strtoupper($filename), strtoupper($request->answer), $perc);
                    if ($perc == 100) {
                        $content = [];
                        $fh = fopen(storage_path('app\\challenges\\'.$filename.'.'.$ext), 'r');
                        while ($line = fgets($fh)) {
                            array_push($content, $line);
                        }
                        fclose($fh);
                        return redirect()->back()->with([
                            'message' => 'Exactly!',
                            'content' => $content,
                        ]);
                    }
                    return redirect()->back()->with([
                        'message' => 'The answer is correct ' . $perc . '%!',
                    ]);
                }
            }
        }
        return redirect()->back();
    }

    public function delete($id)
    {
        if (Controller::checkrole()) {
            $challenge = Challenges::where('id', $id)->first();
            if ($challenge) {
                Storage::delete('challenges/' . $challenge->filename);
                $challenge->delete();
            }
        }
        return redirect()->route('challenges');
    }
}
