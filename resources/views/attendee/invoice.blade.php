@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Invoice: {{ $ticket->payment_id }}</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Invoice: {{ $ticket->payment_id }}</li>
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
                <div class="invoice-container" id="print_invoice">
                    <div class="invoice-top">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <img src="{{ asset('uploads/'.$setting->logo) }}" alt="" class="h_70">
                                                </td>
                                                <td class="w-50">
                                                    <div class="invoice-top-right">
                                                        <h4>Invoice</h4>
                                                        <h5>Order No: {{ $ticket->payment_id }}</h5>
                                                        <h5>Date: {{ $ticket->created_at->format('Y-m-d') }}</h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-middle">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <tr>
                                                <td class="w-50">
                                                    <div class="invoice-middle-left">
                                                        <h4>Invoice To:</h4>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->name }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->email }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->phone }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->address }}</p>
                                                        <p class="mb_0">{{ Auth::guard('web')->user()->state }}, {{ Auth::guard('web')->user()->city }}, {{ Auth::guard('web')->user()->zip }}</p>
                                                    </div>
                                                </td>
                                                <td class="w-50">
                                                    <div class="invoice-middle-right">
                                                        <h4>Invoice From:</h4>
                                                        <p class="mb_0">{{ env('APP_NAME') }}</p>
                                                        <p class="mb_0 color_6d6d6d">{{ $admin->name }}</p>
                                                        <p class="mb_0">{{ $admin->email }}</p>
                                                        <p class="mb_0">Bensalem, PA, 19020</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-item">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered invoice-item-table">
                                        <tbody>
                                            <tr>
                                                <th>SL</th>
                                                <th>Ticket Package</th>
                                                <th>Payment Status</th>
                                                <th class="text-center">Per Ticket Price</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-right">Subtotal</th>
                                            </tr>
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $ticket->package_name }}</td>
                                                <td>{{ $ticket->payment_status }}</td>
                                                <td class="text-center">${{ $ticket->per_ticket_price }}</td>
                                                <td class="text-center">{{ $ticket->total_tickets }}</td>
                                                <td class="text-right">${{ $ticket->total_price }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-bottom">
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-border-0">
                                        <tbody>
                                            <td class="w-70 invoice-bottom-payment">
                                                <h4>Payment Method</h4>
                                                <p>{{ $ticket->payment_method }}</p>
                                            </td>
                                            <td class="w-30 tar invoice-bottom-total-box">
                                                <p class="mb_0">Total Price: <span>${{ $ticket->total_price }}</span></p>
                                            </td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="print-button mt_25">
                    <a onclick="printInvoice()" href="javascript:;" class="btn btn-primary"><i class="fa fa-print"></i> Print</a>
                </div>
                <script>
                    function printInvoice() {
                        let body = document.body.innerHTML;
                        let data = document.getElementById('print_invoice').innerHTML;
                        document.body.innerHTML = data;
                        window.print();
                        document.body.innerHTML = body;
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection