@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Photo Gallery</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Photo Gallery</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="gallery-section" class="pt_50 pb_50 gray projects">
    <div class="container">
        <div class="row gallery_item">
            @foreach($photos as $photo)
            <div class="col-lg-4 col-sm-6 col-xs-12 main-gallery">
                <div class="project-single">
                    <div class="project-inner">
                        <div class="project-head">
                            <img src="{{ asset('uploads/'.$photo->photo) }}" alt="#">
                        </div>
                        <div class="project-bottom">
                            <h4>{{ $photo->caption }}</h4>
                        </div>
                        <div class="button">
                            <a class="gallery_img btn" href="{{ asset('uploads/'.$photo->photo) }}"><i class="fa fa-picture-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="col-md-12">
                {{ $photos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection