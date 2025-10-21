@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Messages with {{ $attendee->name }}</h1>
        </div>
       
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="message-heading">Write Message</h4>
                            <form action="{{ route('admin_message_detail_submit',$attendee->id) }}" method="post">
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
                                $user_name = Auth::guard('admin')->user()->name;
                                $designation = 'Admin';
                                $photo = Auth::guard('admin')->user()->photo;
                            } else {
                                $message_class = '';
                                $user_name = $attendee->name;
                                $designation = 'Attendee';
                                $photo = $attendee->photo;
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
        </div>
    </section>
</div>
@endsection