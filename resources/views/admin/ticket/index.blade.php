@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Tickets</h1>
            {{-- <div class="section-header-button">
                <a href="{{ route('admin_ticket_create') }}" class="btn btn-primary">Add New</a>
            </div> --}}
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Package</th>
                                            <th>Payment Id</th>
                                            <th>Payment Method</th>
                                            <th>Per Ticket Price</th>
                                            <th>Total Tickets</th>
                                            <th>Total Price</th>
                                            <th>Payment Status</th>
                                            <th>Date Time</th>
                                            <th class="w_100">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $ticket->user->name }}<br>
                                                {{ $ticket->user->email }}<br>
                                                <a href="{{ route('admin_attendee_index') }}">
                                                    See Detail
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_package_index') }}">
                                                    {{ $ticket->package->name }}
                                                </a>
                                            </td>
                                            <td>{{ $ticket->payment_id }}</td>
                                            <td>{{ $ticket->payment_method }}</td>
                                            <td>{{ $ticket->per_ticket_price }}</td>
                                            <td>{{ $ticket->total_tickets }}</td>
                                            <td>{{ $ticket->total_price }}</td>
                                            <td>
                                                @if($ticket->payment_status == 'Pending')
                                                @php 
                                                $change_status = 'Completed';
                                                @endphp
                                                <span class="badge badge-danger">Pending</span>
                                                @elseif($ticket->payment_status == 'Completed')
                                                @php
                                                $change_status = 'Pending';
                                                @endphp
                                                <span class="badge badge-success">Completed</span>
                                                @endif
                                                <a href="{{ route('admin_ticket_change_status',[$ticket->id,$change_status]) }}">Change Status</a>
                                            </td>
                                            <td>
                                                {{ $ticket->created_at }}
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modal_{{ $loop->iteration }}"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('admin_ticket_invoice',$ticket->id) }}" class="btn btn-success btn-sm"><i class="fas fa-file-invoice"></i></a>
                                                <a href="{{ route('admin_ticket_delete',$ticket->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                                <div class="modal fade" id="modal_{{ $loop->iteration }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Payment Detail</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>User Name</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->user->name }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>User Email</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->user->email }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing Name</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_name }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing Email</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_email }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing Phone</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_phone }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing Country</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_country }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing Address</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_address }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing State</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_state }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing City</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_city }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Billing Zip</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->billing_zip }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Payment Method</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->payment_method }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Payment Currency</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->payment_currency }}
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Transaction Id</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->transaction_id }}
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row bdb1 pt_10 mb_0">
                                                                    <div class="col-md-4">
                                                                        <b>Bank Transaction Info</b>
                                                                    </div>
                                                                    <div class="col-md-8">
                                                                        {{ $ticket->bank_transaction_info }}
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection