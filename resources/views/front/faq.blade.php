@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Frequently Asked Questions (FAQ)</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">FAQ</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="faq-section" class="pt_50 pb_50 gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div id="accordion" class="faq">

                    @php $i=0; @endphp
                    @foreach($faqs as $faq)
                    @php 
                    $i++; 
                    if($i == 1){
                        $collapsed = '';
                        $aria_expanded = 'true';
                        $show = 'show';
                    } else {
                        $collapsed = 'collapsed';
                        $aria_expanded = 'false';
                        $show = '';
                    }
                    @endphp
                    <div class="card">
                        <div class="card-header" id="heading{{ $loop->iteration }}">
                            <h5 class="mb-0">
                                <button class="btn btn-link {{ $collapsed }}" data-toggle="collapse" data-target="#collapse{{ $loop->iteration }}" aria-expanded="{{ $aria_expanded }}" aria-controls="collapse{{ $loop->iteration }}">
                                    {{ $faq->question }}
                                </button>
                            </h5>
                        </div>
                        <div id="collapse{{ $loop->iteration }}" class="collapse {{ $show }}" aria-labelledby="heading{{ $loop->iteration }}" data-parent="#accordion">
                            <div class="card-body">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection