<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Speaker;
use App\Models\Schedule;
use DB;

class AdminSpeakerScheduleController extends Controller
{
    public function index()
    {
        $speakers = Speaker::orderBy('name','asc')->get();
        $schedules = Schedule::with('schedule_day')->orderBy('id','asc')->get();
        
        $pivot_table_data = DB::table('schedule_speaker')
                        ->join('speakers','schedule_speaker.speaker_id','=','speakers.id')
                        ->join('schedules','schedule_speaker.schedule_id','=','schedules.id')    
                        ->select(
                            'schedule_speaker.*',
                            'speakers.name as speaker_name',
                            'speakers.email as speaker_email',
                            'schedules.schedule_day_id as schedule_id1',
                            'schedules.title as schedule_title'
                        )
                        ->get();

        return view('admin.speaker_schedule.index', compact('speakers', 'schedules', 'pivot_table_data'));
    }

    public function store(Request $request)
    {
        $check = DB::table('schedule_speaker')->where('speaker_id',$request->speaker_id)->where('schedule_id',$request->schedule_id)->first();
        if($check){
            return redirect()->back()->with('error','Speaker already added to this schedule!');
        }

        $speaker = Speaker::find($request->speaker_id);
        $schedule = Schedule::find($request->schedule_id);
        $speaker->schedules()->attach($request->schedule_id);

        return redirect()->back()->with('success','Speaker added to schedule successfully!');
    }

    public function delete($id)
    {
        DB::table('schedule_speaker')->where('id',$id)->delete();

        return redirect()->back()->with('success','Speaker removed from schedule successfully!');
    }
}
