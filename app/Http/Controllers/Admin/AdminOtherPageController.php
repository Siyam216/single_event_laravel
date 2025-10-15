<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactPageItem;
use App\Models\TermPageItem;
use App\Models\PrivacyPageItem;

class AdminOtherPageController extends Controller
{
    public function contact_page()
    {
        $page_data = ContactPageItem::where('id',1)->first();
        return view('admin.other_pages.contact', compact('page_data'));
    }

    public function contact_page_update(Request $request)
    {
        $obj = ContactPageItem::where('id',1)->first();
        $obj->address = $request->address;
        $obj->phone = $request->phone;
        $obj->email = $request->email;
        $obj->map = $request->map;
        $obj->save();

        return redirect()->back()->with('success','Data is updated!');
    }

    public function term_page()
    {
        $page_data = TermPageItem::where('id',1)->first();
        return view('admin.other_pages.term', compact('page_data'));
    }

    public function term_page_update(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $obj = TermPageItem::where('id',1)->first();
        $obj->content = $request->content;
        $obj->save();

        return redirect()->back()->with('success','Data is updated!');
    }

    public function privacy_page()
    {
        $page_data = PrivacyPageItem::where('id',1)->first();
        return view('admin.other_pages.privacy', compact('page_data'));
    }

    public function privacy_page_update(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $obj = PrivacyPageItem::where('id',1)->first();
        $obj->content = $request->content;
        $obj->save();

        return redirect()->back()->with('success','Data is updated!');
    }
}
