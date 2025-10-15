@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Sponsor: {{ $sponsor->name }}</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('sponsors') }}">Sponsors</a></li>
                            <li class="breadcrumb-item active">{{ $sponsor->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="speakers" class="pt_70 pb_70 white team speakers-item">
    <div class="container">

        <div class="row">
            <div class="col-lg-4 col-sm-12 col-xs-12">
                <div class="speaker-detail-img">
                    <img src="{{ asset('uploads/'.$sponsor->featured_photo) }}" alt="">
                </div>
            </div>
            <div class="col-lg-8 col-sm-12 col-xs-12">
                <div class="speaker-detail">
                    <h2>{{ $sponsor->name }}</h2>
                    <h4 class="mb_20">{{ $sponsor->tagline }}</h4>
                    <p>
                        {!! nl2br($sponsor->description) !!}
                    </p>

                    <h4>More Information</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            @if($sponsor->address != '')
                            <tr>
                                <th><b>Address:</b></th>
                                <td>{{ $sponsor->address }}</td>
                            </tr>
                            @endif
                            
                            @if($sponsor->email != '')
                            <tr>
                                <th><b>Email:</b></th>
                                <td>{{ $sponsor->email }}</td>
                            </tr>
                            @endif

                            @if($sponsor->phone != '')
                            <tr>
                                <th><b>Phone:</b></th>
                                <td>{{ $sponsor->phone }}</td>
                            </tr>
                            @endif

                            @if($sponsor->website != '')
                            <tr>
                                <th><b>Website:</b></th>
                                <td>
                                    <a href="{{ $sponsor->website }}" target="_blank">{{ $sponsor->website }}</a>
                                </td>
                            </tr>
                            @endif
                            
                            @if($sponsor->facebook != '' || $sponsor->twitter != '' || $sponsor->linkedin != '' || $sponsor->instagram != '')
                            <tr>
                                <th><b>Social:</b></th>
                                <td>
                                    <ul class="social-icon">
                                        @if($sponsor->facebook != '')
                                        <li>
                                            <a href="{{ $sponsor->facebook }}"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        @endif
                                        @if($sponsor->twitter != '')
                                        <li>
                                            <a href="{{ $sponsor->twitter }}"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        @endif
                                        @if($sponsor->linkedin != '')
                                        <li>
                                            <a href="{{ $sponsor->linkedin }}"><i class="fa fa-linkedin"></i></a>
                                        </li>
                                        @endif
                                        @if($sponsor->instagram != '')
                                        <li>
                                            <a href="{{ $sponsor->instagram }}"><i class="fa fa-instagram"></i></a>
                                        </li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            @endif
                            @if($sponsor->map != '')
                            <tr>
                                <th>Map:</th>
                                <td>
                                    {!! $sponsor->map !!}
                                </td>
                            </tr>
                            @endif
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection