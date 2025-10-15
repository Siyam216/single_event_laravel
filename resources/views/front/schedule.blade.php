@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Schedule</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Schedule</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="schedule-section" class="gray pt_50 pb_50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 schedule-tab">
                <ul id="scheduleTab" class="nav nav-tabs justify-content-center text-center">
                    @foreach($schedule_days as $schedule_day)
                    <li class="nav-item">
                        <a href="#" data-target="#target{{ $loop->iteration }}" data-toggle="tab" class="nav-link @if($loop->iteration == 1) active @endif">
                            <p>{{ $schedule_day->day }}</p>
                            <span>{{ $schedule_day->date1 }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>

                <div id="scheduleTabContent" class="tab-content">

                    @foreach($schedule_days as $schedule_day)
                    <div id="target{{ $loop->iteration }}" class="tab-pane @if($loop->iteration == 1) active show @endif fade">

                        @foreach($schedule_day->schedules as $schedule)
                        <div class="row speaker-mainbox">
                            <div class="col-lg-4 col-xs-12">
                                <div class="speaker-img">
                                    <img src="{{ asset('uploads/'.$schedule->photo) }}">
                                </div>
                            </div>
                            <div class="col-lg-8 col-xs-12">
                                <div class="speaker-box">
                                    <h2>{{ $schedule->name }}</h2>
                                    <h3>{{ $schedule->title }}</h3>
                                    <p>
                                        {!! nl2br($schedule->description) !!}
                                    </p>
                                    <h3>Speakers:</h3>
                                    <h4>
                                        @forelse($schedule->speakers as $speaker)
                                        <a href="{{ route('speaker',$speaker->slug) }}" class="badge badge-primary">{{ $speaker->name }}</a>
                                        @empty
                                        <span class="text-danger">No Speaker is found</span>
                                        @endforelse
                                    </h4>
                                    <h3>Location:</h3>
                                    <h4> 
                                        <span>{{ $schedule->location }}</span>
                                    </h4>
                                    <h3>Time:</h3>
                                    <h4> 
                                        <span>{{ $schedule->time }}</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div>
                    @endforeach
                    
                

                   
                </div>
            </div>
        </div>
    </div>
</div>

@endsection