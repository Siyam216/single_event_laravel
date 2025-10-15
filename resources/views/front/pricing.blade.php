@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Pricing</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Pricing</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="price-section" class="pt_50 pb_70 gray prices">
    <div class="container">
        <div class="row pt_40">


            @foreach($packages as $package)
            <div class="col-md-4 col-sm-12">
                <div class="info">
                    <h5 class="event-ti-style">{{ $package->name }}</h5>
                    <h3 class="event-ti-style">${{ $package->price }}</h3>
                    <ul>
                        @foreach($package->facilities as $facility)
                        @php
                        if($facility->status == 'Yes') {
                            $icon = 'fa-check';
                        } else {
                            $icon = 'fa-times';
                        }
                        @endphp
                        <li><i class="fa {{ $icon }}"></i> {{ $facility->name }}</li>
                        @endforeach
                    </ul>
                    <div class="global_btn mt_20">
                        @if($setting_data->ticket_purchase_expire_date < date('Y-m-d'))
                        <a href="javascript:void;" class="btn_two" style="background-color:#c03030;color:#fff;">TICKET PURCHASE EXPIRED</a>
                        @else
                        <a class="btn_two" href="{{ route('buy_ticket',$package->id) }}">Buy Ticket</a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach



        </div>
    </div>
</div>

@endsection