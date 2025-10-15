<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use App\Mail\Websitemail;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function delete($id)
    {
        $subscriber = Subscriber::where('id',$id)->first();
        $subscriber->delete();

        return redirect()->back()->with('success','Subscriber deleted successfully!');
    }

    public function message_all()
    {
        return view('admin.subscriber.message_all');
    }

    public function message_all_submit(Request $request)
    {
        $request->validate([
            'subject' => ['required'],
            'message' => ['required'],
        ]);

        $subject = $request->subject;
        $message = $request->message;

        $subscribers = Subscriber::where('status','active')->get();
        foreach($subscribers as $subscriber)
        {
            \Mail::to($subscriber->email)->send(new Websitemail($subject,$message));
        }
        return redirect()->back()->with('success','Message sent successfully!');
    }
}
