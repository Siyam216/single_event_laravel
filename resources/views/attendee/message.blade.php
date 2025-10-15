@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Messages</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Messages</li>
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
                <h4 class="message-heading">Write Message</h4>
                <form action="{{ route('attendee_message_submit') }}" method="post">
                    @csrf
                    <div class="mb-2">
                        <textarea name="message" class="form-control h_100" cols="30" rows="10" placeholder="Write your message here"></textarea>
                    </div>
                    <div class="mb-2 text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <h4 class="message-heading mt_40">All Messages</h4>
                
                @forelse($messages as $message)
                @php
                if($message->admin_id == 1) {
                    $message_class = 'message-item-admin-border';
                    $user_name = $admin->name;
                    $designation = 'Admin';
                    $photo = $admin->photo;
                } else {
                    $message_class = '';
                    $user_name = Auth::guard('web')->user()->name;
                    $designation = 'Attendee';
                    $photo = Auth::guard('web')->user()->photo;
                    if($photo == '') {
                        $photo = 'default.png';
                    }
                }
                @endphp
                <div class="message-item {{ $message_class }}">
                    <div class="message-top">
                        <div class="left">
                            <img src="{{ asset('uploads/'.$photo) }}" alt="">
                        </div>
                        <div class="right">
                            <h4>{{ $user_name }}</h4>
                            <h5>{{ $designation }}</h5>
                            <div class="date-time">{{ $message->create_at }}</div>
                        </div>
                    </div>
                    <div class="message-bottom">
                        <p>
                            {!! nl2br($message->message) !!}
                        </p>
                    </div>
                </div>
                @empty
                <div style="background:#f0c9cc;padding:10px;border-radius:3px;">
                    No message found
                </div>
                @endforelse

            </div>
        </div>
    </div>
</div>
@endsection