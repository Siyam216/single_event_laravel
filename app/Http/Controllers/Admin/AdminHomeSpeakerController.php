<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSpeaker;

class AdminHomeSpeakerController extends Controller
{
    public function index()
    {
        $home_speaker = HomeSpeaker::where('id',1)->first();
        return view('admin.home_speaker.index', compact('home_speaker'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => ['required'],
            'how_many' => ['required'],
        ]);

        $home_speaker = HomeSpeaker::where('id',1)->first();
        $home_speaker->heading = $request->heading;
        $home_speaker->description = $request->description;
        $home_speaker->how_many = $request->how_many;
        $home_speaker->status = $request->status;
        $home_speaker->save();

        return redirect()->back()->with('success','Data is updated!');
    }
}
