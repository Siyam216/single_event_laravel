@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Bank Payment</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">bank Payment</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="contacts" class="pt_70 pb_50 white">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <div class="contact">
                    <form class="form" method="post" action="{{ route('bank_success') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <h3>Bank Information (You have to pay here):</h3>
                                <p>
                                    <br>
                                    Bank Name: Test<br>
                                    Bank Account Number: 89293472987349<br>
                                    Bank Routing Number: 454542<br>
                                    Bank Swift Code: 12122<br>
                                    Bank Branch: Khulna
                                </p>
                            </div>
                            <div class="form-group col-md-12">
                                <textarea rows="3" name="bank_transaction_info" class="form-control" placeholder="Bank Transaction Information"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="actions">
                                    <input value="Send Message" name="submit" class="btn btn-lg btn-con-bg" type="submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection