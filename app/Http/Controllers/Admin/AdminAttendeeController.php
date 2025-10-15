<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminAttendeeController extends Controller
{
    public function index()
    {
        $attendees = User::get();
        return view('admin.attendee.index', compact('attendees'));
    }

    public function create()
    {
        return view('admin.attendee.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required','email','unique:users'],
            'password' => ['required'],
            'confirm_password' => ['required','same:password'],
            'photo' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
        ]);

        $final_name = 'attendee_'.time().'.'.$request->photo->extension();
        $request->photo->move(public_path('uploads'), $final_name);

        $attendee = new User();
        $attendee->name = $request->name;
        $attendee->email = $request->email;
        $attendee->photo = $final_name;
        $attendee->password = bcrypt($request->password);
        $attendee->phone = $request->phone;
        $attendee->address = $request->address;
        $attendee->country = $request->country;
        $attendee->state = $request->state;
        $attendee->city = $request->city;
        $attendee->zip = $request->zip;
        $attendee->token = '';
        $attendee->status = $request->status;
        $attendee->save();

        return redirect()->route('admin_attendee_index')->with('success','Attendee created successfully!');
    }

    public function edit($id)
    {
        $attendee = User::where('id',$id)->first();
        return view('admin.attendee.edit', compact('attendee'));
    }

    public function update(Request $request,$id)
    {
        $attendee = User::where('id',$id)->first();

        $request->validate([
            'name' => ['required'],
            'email' => ['required','email',Rule::unique('users')->ignore($attendee->id)],
        ]);

        if($request->photo) {
            $request->validate([
                'photo' => ['image','mimes:jpg,jpeg,png,gif','max:2024'],
            ]);
            $final_name = 'attendee_'.time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads'), $final_name);
            unlink(public_path('uploads/'.$attendee->photo));
            $attendee->photo = $final_name;
        }

        if($request->password) {
            $request->validate([
                'password' => ['required'],
                'confirm_password' => ['required','same:password'],
            ]);
            $attendee->password = bcrypt($request->password);
        }

        $attendee->name = $request->name;
        $attendee->email = $request->email;
        $attendee->phone = $request->phone;
        $attendee->address = $request->address;
        $attendee->country = $request->country;
        $attendee->state = $request->state;
        $attendee->city = $request->city;
        $attendee->zip = $request->zip;
        $attendee->status = $request->status;
        $attendee->save();

        return redirect()->route('admin_attendee_index')->with('success','Attendee updated successfully!');
    }

    public function delete($id)
    {
        $attendee = User::where('id',$id)->first();
        unlink(public_path('uploads/'.$attendee->photo));
        $attendee->delete();

        return redirect()->route('admin_attendee_index')->with('success','Attendee deleted successfully!');
    }
}
