@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>{{ $post->title }}</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                            <li class="breadcrumb-item active">{{ $post->title }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="blog-section" class="pt_50 pb_50 white blog-section blogSectionInn">
    <div class="container">
        <div class="row">
            <div class="page-contents col-lg-12 col-sm-12 col-xs-12"> 
                <div class="blogs-featured">
                    <img src="{{ asset('uploads/'.$post->photo) }}" alt="">
                </div>
                <div class="blog-post-meta">
                    <ul class="post-meta">
                        <li class="post-date"><span>Posted On:</span> {{ $post->created_at->format('F d, Y') }}</li>
                    </ul>
                </div>
                <div class="post-details awt-track">
                    <p>
                        {!! $post->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection