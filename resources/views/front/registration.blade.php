@extends('front.layout.master')

@section('main_content')

<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Create Account</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Account</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="Loginsection" class="pt_50 pb_50 gray Loginsection">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-register-bg">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <form action="{{ route('registration_submit') }}" class="registerd" method="post">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" name="name" placeholder="Name" type="text" value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" placeholder="Email Address" type="text" value="{{ old('email') }}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="password" placeholder="Password" type="password">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="confirm_password" placeholder="Confirm Password" type="password">
                                </div>
                                <div class="form-group">
                                    <button type="submit">
                                        REGISTER NOW
                                    </button>
                                </div>
                                <div class="form-group bottom">
                                    <a href="{{ route('login') }}">Are you a already member? Login now!</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection