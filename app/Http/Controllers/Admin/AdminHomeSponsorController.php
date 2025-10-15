<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeSponsor;

class AdminHomeSponsorController extends Controller
{
    public function index()
    {
        $home_sponsor = HomeSponsor::where('id',1)->first();
        return view('admin.home_sponsor.index', compact('home_sponsor'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => ['required'],
            'how_many' => ['required'],
        ]);

        $home_sponsor = HomeSponsor::where('id',1)->first();
        $home_sponsor->heading = $request->heading;
        $home_sponsor->description = $request->description;
        $home_sponsor->how_many = $request->how_many;
        $home_sponsor->status = $request->status;
        $home_sponsor->save();

        return redirect()->back()->with('success','Data is updated!');
    }
}
