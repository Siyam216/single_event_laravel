@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Organizers</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Organizers</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="speakers" class="pt_50 pb_50 gray team speakers-item">
    <div class="container">
        <div class="row pt_40">
            @foreach($organisers as $organiser)
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="team-img mb_20">
                    <a href="{{ route('organiser',$organiser->slug) }}"><img src="{{ asset('uploads/'.$organiser->photo) }}"></a>
                </div>
                <div class="team-info text-center">
                    <h6><a href="{{ route('organiser',$organiser->slug) }}">{{ $organiser->name }}</a></h6>
                    <p>{{ $organiser->designation }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection