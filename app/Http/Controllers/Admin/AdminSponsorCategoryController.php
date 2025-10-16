<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SponsorCategory;
use App\Models\Sponsor;

class AdminSponsorCategoryController extends Controller
{
    public function index()
    {
        $sponsor_categories = SponsorCategory::get();
        return view('admin.sponsor_category.index', compact('sponsor_categories'));
    }

    public function create()
    {
        return view('admin.sponsor_category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $sponsor_category = new SponsorCategory();
        $sponsor_category->name = $request->name;
        $sponsor_category->description = $request->description;
        $sponsor_category->save();

        return redirect()->route('admin_sponsor_category_index')->with('success','Sponsor Category is created successfully!');
    }
  // for editing the id
    public function edit($id)
    {
        $sponsor_category = SponsorCategory::where('id',$id)->first();
        return view('admin.sponsor_category.edit', compact('sponsor_category'));
    }

    public function update(Request $request,$id)
    {
        $sponsor_category = SponsorCategory::where('id',$id)->first();

        $request->validate([
            'name' => ['required'],
        ]);

        $sponsor_category->name = $request->name;
        $sponsor_category->description = $request->description;
        $sponsor_category->save();

        return redirect()->route('admin_sponsor_category_index')->with('success','Sponsor Category is updated successfully!');
    }

    public function delete($id)
    {
        // Check if there is sponsor under this category
        $sponsor = Sponsor::where('sponsor_category_id',$id)->first();
        if($sponsor){
            return redirect()->route('admin_sponsor_category_index')->with('error','Sponsor Category is not empty!');
        }

        $sponsor_category = SponsorCategory::where('id',$id)->first();
        $sponsor_category->delete();

        return redirect()->route('admin_sponsor_category_index')->with('success','Sponsor Category is deleted successfully!');
    }
}
