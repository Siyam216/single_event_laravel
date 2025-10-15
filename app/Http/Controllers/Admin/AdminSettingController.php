<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    public function logo()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.logo', compact('setting'));
    }

    public function logo_submit(Request $request)
    {
        $setting = Setting::where('id',1)->first();
        $request->validate([
            'logo' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
        ]);
        $final_name = 'logo_'.time().'.'.$request->logo->extension();
        $request->logo->move(public_path('uploads'), $final_name);
        unlink(public_path('uploads/'.$setting->logo));
        $setting->logo = $final_name;
        $setting->save();

        return redirect()->back()->with('success','Logo updated successfully!');
    }

    public function favicon()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.favicon', compact('setting'));
    }

    public function favicon_submit(Request $request)
    {
        $setting = Setting::where('id',1)->first();
        $request->validate([
            'favicon' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
        ]);
        $final_name = 'favicon_'.time().'.'.$request->favicon->extension();
        $request->favicon->move(public_path('uploads'), $final_name);
        unlink(public_path('uploads/'.$setting->favicon));
        $setting->favicon = $final_name;
        $setting->save();

        return redirect()->back()->with('success','Favicon updated successfully!');
    }


    public function banner()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.banner', compact('setting'));
    }

    public function banner_submit(Request $request)
    {
        $setting = Setting::where('id',1)->first();
        $request->validate([
            'banner' => ['required','image','mimes:jpg,jpeg,png,gif','max:2024'],
        ]);
        $final_name = 'banner_'.time().'.'.$request->banner->extension();
        $request->banner->move(public_path('uploads'), $final_name);
        unlink(public_path('uploads/'.$setting->banner));
        $setting->banner = $final_name;
        $setting->save();

        return redirect()->back()->with('success','Banner updated successfully!');
    }

    public function footer()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.footer', compact('setting'));
    }

    public function footer_submit(Request $request)
    {
        $request->validate([
            'copyright' => ['required'],
        ]);
        $setting = Setting::where('id',1)->first();
        $setting->copyright = $request->copyright;
        $setting->footer_address = $request->footer_address;
        $setting->footer_email = $request->footer_email;
        $setting->footer_phone = $request->footer_phone;
        $setting->footer_facebook = $request->footer_facebook;
        $setting->footer_twitter = $request->footer_twitter;
        $setting->footer_instagram = $request->footer_instagram;
        $setting->footer_linkedin = $request->footer_linkedin;
        $setting->save();

        return redirect()->back()->with('success','Footer Setting updated successfully!');
    }


    public function ticket()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.ticket', compact('setting'));
    }

    public function ticket_submit(Request $request)
    {
        $request->validate([
            'ticket_purchase_expire_date' => ['required'],
        ]);
        $setting = Setting::where('id',1)->first();
        $setting->ticket_purchase_expire_date = $request->ticket_purchase_expire_date;
        $setting->save();

        return redirect()->back()->with('success','Ticket Setting updated successfully!');
    }


    public function theme_color()
    {
        $setting = Setting::where('id',1)->first();
        return view('admin.setting.theme_color', compact('setting'));
    }

    public function theme_color_submit(Request $request)
    {
        $request->validate([
            'theme_color' => ['required'],
        ]);
        $setting = Setting::where('id',1)->first();
        $setting->theme_color = $request->theme_color;
        $setting->save();

        return redirect()->back()->with('success','Theme Color updated successfully!');
    }
}
