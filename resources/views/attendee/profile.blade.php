@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Profile</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="user-section pt_70 pb_70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="user-sidebar">
                    <div class="card">
                        @include('front.layout.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <form action="{{ route('attendee_profile_submit') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Existing Photo:</label>
                        <div>
                            @if(Auth::guard('web')->user()->photo == '')
                            <img src="{{ asset('uploads/default.png') }}" alt="" class="w_150">
                            @else
                            <img src="{{ asset('uploads/'.Auth::guard('web')->user()->photo) }}" alt="" class="w_150">
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Change Photo:</label>
                        <div>
                            <input type="file" name="photo">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Name *</label>
                                <input type="text" class="form-control" name="name" value="{{ Auth::guard('web')->user()->name }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Email *</label>
                                <input type="text" class="form-control" name="email" value="{{ Auth::guard('web')->user()->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Phone *</label>
                                <input type="text" class="form-control" name="phone" value="{{ Auth::guard('web')->user()->phone }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Address *</label>
                                <input type="text" class="form-control" name="address" value="{{ Auth::guard('web')->user()->address }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Country *</label>
                                <input type="text" class="form-control" name="country" value="{{ Auth::guard('web')->user()->country }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">State *</label>
                                <input type="text" class="form-control" name="state" value="{{ Auth::guard('web')->user()->state }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">City *</label>
                                <input type="text" class="form-control" name="city" value="{{ Auth::guard('web')->user()->city }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Zip Code *</label>
                                <input type="text" class="form-control" name="zip" value="{{ Auth::guard('web')->user()->zip }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection