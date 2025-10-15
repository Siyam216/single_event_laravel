<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speaker;
use Illuminate\Validation\Rule;

class AdminSpeakerController extends Controller
{
    public function index()
    {
        $speakers = Speaker::get();
        return view('admin.speaker.index', compact('speakers'));
    }

    public function create()
    {
        return view('admin.speaker.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'slug' => ['required','alpha_dash','regex:/^[a-zA-Z-]+$/','unique:speakers'],
            'designation' => ['required'],
            'photo' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
            'email' => ['required','email','unique:speakers'],
            'phone' => ['required','unique:speakers'],
        ]);

        $final_name = 'speaker_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $speaker = new Speaker();
        $speaker->name = $request->name;
        $speaker->slug = $request->slug;
        $speaker->designation = $request->designation;
        $speaker->photo = $final_name;
        $speaker->email = $request->email;
        $speaker->phone = $request->phone;
        $speaker->biography = $request->biography;
        $speaker->address = $request->address;
        $speaker->website = $request->website;
        $speaker->facebook = $request->facebook;
        $speaker->twitter = $request->twitter;
        $speaker->linkedin = $request->linkedin;
        $speaker->instagram = $request->instagram;
        $speaker->save();

        return redirect()->route('admin_speaker_index')->with('success','Speaker created successfully!');
    }

    public function edit($id)
    {
        $speaker = Speaker::where('id',$id)->first();
        return view('admin.speaker.edit', compact('speaker'));
    }

    public function update(Request $request,$id)
    {
        $speaker = Speaker::where('id',$id)->first();

        $request->validate([
            'name' => ['required'],
            'slug' => ['required','alpha_dash','regex:/^[a-zA-Z-]+$/',Rule::unique('speakers')->ignore($id)],
            'designation' => ['required'],
            'email' => ['required','email',Rule::unique('speakers')->ignore($id)],
            'phone' => ['required',Rule::unique('speakers')->ignore($id)],
        ]);

        if($request->photo) {
            $request->validate([
                'photo' => ['image','mimes:jpg,jpeg,png,gif','max:2024'],
            ]);
            $final_name = 'speaker_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            unlink(public_path('uploads/'.$speaker->photo));
            $speaker->photo = $final_name;
        }

        $speaker->name = $request->name;
        $speaker->slug = $request->slug;
        $speaker->designation = $request->designation;
        $speaker->email = $request->email;
        $speaker->phone = $request->phone;
        $speaker->biography = $request->biography;
        $speaker->address = $request->address;
        $speaker->website = $request->website;
        $speaker->facebook = $request->facebook;
        $speaker->twitter = $request->twitter;
        $speaker->linkedin = $request->linkedin;
        $speaker->instagram = $request->instagram;
        $speaker->save();

        return redirect()->route('admin_speaker_index')->with('success','Speaker updated successfully!');
    }

    public function delete($id)
    {
        $speaker = Speaker::where('id',$id)->first();
        unlink(public_path('uploads/'.$speaker->photo));
        $speaker->delete();

        return redirect()->route('admin_speaker_index')->with('success','Speaker deleted successfully!');
    }
}
