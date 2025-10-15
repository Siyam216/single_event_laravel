@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Speakers</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Speakers</li>
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
            @foreach($speakers as $speaker)
            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="team-img mb_20">
                    <a href="{{ route('speaker',$speaker->slug) }}"><img src="{{ asset('uploads/'.$speaker->photo) }}"></a>
                </div>
                <div class="team-info text-center">
                    <h6><a href="{{ route('speaker',$speaker->slug) }}">{{ $speaker->name }}</a></h6>
                    <p>{{ $speaker->designation }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection