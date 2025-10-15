@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Blog</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Blog</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="blog-section" class="pt_50 pb_50 white blog-section">
    <div class="container">
        <div class="row pt_40">

            @foreach($posts as $post)
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="blog-box text-center">
                    <div class="blog-post-images">
                        <a href="{{ route('post',$post->slug) }}">
                            <img src="{{ asset('uploads/'.$post->photo) }}" alt="image">
                        </a>
                    </div>
                    <div class="blogs-post">
                        <h4><a href="{{ route('post',$post->slug) }}">{{ $post->title }}</a></h4>
                        <p>
                            {!! nl2br($post->short_description) !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
            
            
        </div>
    </div>
</div>

@endsection