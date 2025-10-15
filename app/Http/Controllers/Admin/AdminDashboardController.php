<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Testimonial;
use App\Models\Speaker;
use App\Models\ScheduleDay;
use App\Models\Sponsor;
use App\Models\Organiser;
use App\Models\User;
use App\Models\Package;
use App\Models\Ticket;
use App\Models\Subscriber;
use App\Models\Photo;
use App\Models\Video;

class AdminDashboardController extends Controller
{
    public function dashboard()
    {
        $total_posts = Post::count();
        $total_testimonials = Testimonial::count();
        $total_speakers = Speaker::count();
        $total_schedule_days = ScheduleDay::count();
        $total_sponsors = Sponsor::count();
        $total_organisers = Organiser::count();
        $total_attendees = User::count();
        $total_packages = Package::count();
        $total_tickets = Ticket::count();
        $total_subscribers = Subscriber::count();
        $total_photos = Photo::count();
        $total_videos = Video::count();

        $tickets = Ticket::with(['package','user'])->orderBy('id','desc')->get()->take(3);

        return view('admin.dashboard', compact('total_posts', 'total_testimonials', 'total_speakers', 'total_schedule_days', 'total_sponsors', 'total_organisers', 'total_attendees', 'total_packages', 'total_tickets', 'total_subscribers', 'total_photos', 'total_videos', 'tickets'));
    }
}
