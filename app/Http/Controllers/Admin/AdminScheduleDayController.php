<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScheduleDay;
use App\Models\Schedule;

class AdminScheduleDayController extends Controller
{
    public function index()
    {
        $schedule_days = ScheduleDay::orderBy('order1','asc')->get();
        return view('admin.schedule_day.index', compact('schedule_days'));
    }

    public function create()
    {
        return view('admin.schedule_day.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'day' => ['required'],
            'date1' => ['required'],
            'order1' => ['required'],
        ],[],[
            'day' => 'Day',
            'date1' => 'Date',
            'order1' => 'Order',
        ]);

        $schedule_day = new ScheduleDay();
        $schedule_day->day = $request->day;
        $schedule_day->date1 = $request->date1;
        $schedule_day->order1 = $request->order1;
        $schedule_day->save();

        return redirect()->route('admin_schedule_day_index')->with('success','Schedule Day created successfully!');
    }

    public function edit($id)
    {
        $schedule_day = ScheduleDay::where('id',$id)->first();
        return view('admin.schedule_day.edit', compact('schedule_day'));
    }

    public function update(Request $request,$id)
    {
        $schedule_day = ScheduleDay::where('id',$id)->first();

        $request->validate([
            'day' => ['required'],
            'date1' => ['required'],
            'order1' => ['required'],
        ],[],[
            'day' => 'Day',
            'date1' => 'Date',
            'order1' => 'Order',
        ]);

        $schedule_day->day = $request->day;
        $schedule_day->date1 = $request->date1;
        $schedule_day->order1 = $request->order1;
        $schedule_day->save();

        return redirect()->route('admin_schedule_day_index')->with('success','Schedule Day updated successfully!');
    }

    public function delete($id)
    {
        $check = Schedule::where('schedule_day_id',$id)->first();
        if($check) {
            return redirect()->route('admin_schedule_day_index')->with('error','You can not delete this schedule day, because it has one or more schedules!');
        }

        $schedule_day = ScheduleDay::where('id',$id)->first();
        $schedule_day->delete();

        return redirect()->route('admin_schedule_day_index')->with('success','Schedule Day deleted successfully!');
    }
}
