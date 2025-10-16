<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Validation\Rule;

//admin video controller
class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return view('admin.video_gallery.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.video_gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => ['required'],
        ]);

        $video = new Video();
        $video->video = $request->video;
        $video->caption = $request->caption;
        $video->save();

        return redirect()->route('admin_video_index')->with('success','Video created successfully!');
    }

    public function edit($id)
    {
        $video = Video::where('id',$id)->first();
        return view('admin.video_gallery.edit', compact('video'));
    }

    public function update(Request $request,$id)
    {
        $video = Video::where('id',$id)->first();
        $request->validate([
            'video' => ['required'],
        ]);
        $video->video = $request->video;
        $video->caption = $request->caption;
        $video->save();

        return redirect()->route('admin_video_index')->with('success','Video updated successfully!');
    }

    public function delete($id)
    {
        $video = Video::where('id',$id)->first();
        $video->delete();

        return redirect()->route('admin_video_index')->with('success','Video deleted successfully!');
    }
}
