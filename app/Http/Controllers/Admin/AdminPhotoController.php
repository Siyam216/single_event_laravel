<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Illuminate\Validation\Rule;

class AdminPhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::get();
        return view('admin.photo_gallery.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.photo_gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
        ]);

        $final_name = 'photo_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $photo = new Photo();
        $photo->photo = $final_name;
        $photo->caption = $request->caption;
        $photo->save();

        return redirect()->route('admin_photo_index')->with('success','Photo created successfully!');
    }

    public function edit($id)
    {
        $photo = Photo::where('id',$id)->first();
        return view('admin.photo_gallery.edit', compact('photo'));
    }

    public function update(Request $request,$id)
    {
        $photo = Photo::where('id',$id)->first();

        if($request->photo) {
            $request->validate([
                'photo' => ['image','mimes:jpg,jpeg,png,gif','max:2024'],
            ]);
            $final_name = 'photo_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            unlink(public_path('uploads/'.$photo->photo));
            $photo->photo = $final_name;
        }

        $photo->caption = $request->caption;
        $photo->save();

        return redirect()->route('admin_photo_index')->with('success','Photo updated successfully!');
    }

    public function delete($id)
    {
        $photo = Photo::where('id',$id)->first();
        unlink(public_path('uploads/'.$photo->photo));
        $photo->delete();

        return redirect()->route('admin_photo_index')->with('success','Photo deleted successfully!');
    }    
}
