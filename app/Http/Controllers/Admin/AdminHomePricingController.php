<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomePricing;

class AdminHomePricingController extends Controller
{
    public function index()
    {
        $home_pricing = HomePricing::where('id',1)->first();
        return view('admin.home_pricing.index', compact('home_pricing'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => ['required'],
            'how_many' => ['required'],
        ]);

        $home_pricing = HomePricing::where('id',1)->first();
        $home_pricing->heading = $request->heading;
        $home_pricing->description = $request->description;
        $home_pricing->how_many = $request->how_many;
        $home_pricing->status = $request->status;
        $home_pricing->save();

        return redirect()->back()->with('success','Data is updated!');
    }
}
