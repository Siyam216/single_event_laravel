<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accommodation;
use Illuminate\Validation\Rule;

class AdminAccommodationController extends Controller
{
    public function index()
    {
        $accommodations = Accommodation::get();
        return view('admin.accommodation.index', compact('accommodations'));
    }

    public function create()
    {
        return view('admin.accommodation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'photo' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
        ]);

        $final_name = 'accommodation_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $accommodation = new Accommodation();
        $accommodation->name = $request->name;
        $accommodation->description = $request->description;
        $accommodation->photo = $final_name;
        $accommodation->address = $request->address;
        $accommodation->email = $request->email;
        $accommodation->phone = $request->phone;
        $accommodation->website = $request->website;
        $accommodation->save();

        return redirect()->route('admin_accommodation_index')->with('success','Accommodation created successfully!');
    }

    public function edit($id)
    {
        $accommodation = Accommodation::where('id',$id)->first();
        return view('admin.accommodation.edit', compact('accommodation'));
    }

    public function update(Request $request,$id)
    {
        $accommodation = Accommodation::where('id',$id)->first();

        $request->validate([
            'name' => ['required'],
            'description' => ['required'],
        ]);

        if($request->photo) {
            $request->validate([
                'photo' => ['image','mimes:jpg,jpeg,png,gif','max:2024'],
            ]);
            $final_name = 'accommodation_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            unlink(public_path('uploads/'.$accommodation->photo));
            $accommodation->photo = $final_name;
        }

        $accommodation->name = $request->name;
        $accommodation->description = $request->description;
        $accommodation->address = $request->address;
        $accommodation->email = $request->email;
        $accommodation->phone = $request->phone;
        $accommodation->website = $request->website;
        $accommodation->save();

        return redirect()->route('admin_accommodation_index')->with('success','Accommodation updated successfully!');
    }

    public function delete($id)
    {
        $accommodation = Accommodation::where('id',$id)->first();
        unlink(public_path('uploads/'.$accommodation->photo));
        $accommodation->delete();

        return redirect()->route('admin_accommodation_index')->with('success','Accommodation deleted successfully!');
    }
}
