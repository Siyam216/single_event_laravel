@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Testimonials</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Testimonials</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gallery-section" class="pt_50 pb_70 gray testimonialSec1">
    <div class="container">
        <div class="row pt_40">
            <div class="col-md-12">
                <div id="testimonial-slider" class="owl-carousel">

                    @foreach($testimonials as $testimonial)
                    <div class="testimonial">
                        <div class="testimonial-content">
                            <div class="testimonial-icon"><i class="fa fa-quote-left"></i></div>
                            <p class="description">
                                {!! nl2br($testimonial->comment) !!}
                            </p>
                        </div>
                        <div class="photo"><img src="{{ asset('uploads/'.$testimonial->photo) }}" alt=""></div>
                        <h3 class="title">{{ $testimonial->name }}</h3>
                        <span class="post">{{ $testimonial->designation }}</span>
                    </div>
                    @endforeach

                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection