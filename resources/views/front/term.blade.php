@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Terms of Use</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Terms of Use</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="black-page pt_50 pb_50 gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                {!! $term_page_data->content !!}
                
            </div>
        </div>
    </div>
</div>
@endsection