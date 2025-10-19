@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Invoice</h1>
            <div class="section-header-button">
                <a href="{{ route('admin_ticket_index') }}" class="btn btn-primary">Back to Tickets Page</a>
            </div>
        </div>
        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="invoice-title">
                                <h2>Invoice</h2>
                                <div class="invoice-number">Order #{{ $ticket->payment_id }}</div>
                            </div>
                            <hr>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <address>
                                        <strong>Invoice To</strong><br>
                                        {{ $ticket->user->name }}<br>
                                        {{ $ticket->user->address }}<br>
                                        {{ $ticket->user->state }}, {{ $ticket->user->city }}, {{ $ticket->user->country }}, {{ $ticket->user->zip }}.
                                    </address>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-right" style="text-align:right;">
                                        <strong>Invoice Date</strong><br>
                                        {{ $ticket->created_at->format('F d, Y') }}<br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="section-title">Order Summary</div>
                            <hr class="invoice-above-table">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        <th>SL</th>
                                        <th>Ticket Package</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th class="text-center">Per Ticket Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-right">Subtotal</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ $ticket->package_name }}</td>
                                        <td>{{ $ticket->payment_method }}</td>
                                        <td>{{ $ticket->payment_status }}</td>
                                        <td class="text-center">${{ $ticket->per_ticket_price }}</td>
                                        <td class="text-center">{{ $ticket->total_tickets }}</td>
                                        <td class="text-right">${{ $ticket->total_price }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12" style="text-align:right;">
                                    <div class="invoice-detail-item">
                                        <div class="invoice-detail-name">Total</div>
                                        <div class="invoice-detail-value invoice-detail-value-lg">${{ $ticket->total_price }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="about-print-button">
                <div class="text-md-right">
                    <a href="javascript:window.print();" class="btn btn-warning btn-icon icon-left text-white print-invoice-button"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection