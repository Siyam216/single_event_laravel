@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Sponsors</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Sponsors</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sponsorsectionList" class="pt_50 pb_50 white">
    <div class="container">

        @foreach($sponsor_categories as $sponsor_category)
        <div class="row">
            <div class="col-sm-1 col-lg-2"></div>
            <div class="col-xs-12 col-sm-10 col-lg-8 text-center">
                <h2 class="title-1 mb_10"><span class="color_red">{{ $sponsor_category->name }}</span></h2>
                <p class="heading-space">
                    {{ nl2br($sponsor_category->description) }}
                </p>
            </div>
            <div class="col-sm-1 col-lg-2"></div>
        </div>

        <div class="row pt_40 mb_50">
            @foreach($sponsor_category->sponsors as $sponsor)
            <div class="col-md-3">
                <div class="sponsors-logo">
                    <a href="{{ route('sponsor',$sponsor->slug) }}"><img src="{{ asset('uploads/'.$sponsor->logo) }}" class="img-responsive" alt=""></a>
                </div>
            </div>
            @endforeach
        </div>
        @endforeach

    </div>
</div>
@endsection