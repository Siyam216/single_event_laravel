<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeBlog;

class AdminHomeBlogController extends Controller
{
    public function index()
    {
        $home_blog = HomeBlog::where('id',1)->first();
        return view('admin.home_blog.index', compact('home_blog'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'heading' => ['required'],
            'how_many' => ['required'],
        ]);

        $home_blog = HomeBlog::where('id',1)->first();
        $home_blog->heading = $request->heading;
        $home_blog->description = $request->description;
        $home_blog->how_many = $request->how_many;
        $home_blog->status = $request->status;
        $home_blog->save();

        return redirect()->back()->with('success','Data is updated!');
    }
}
