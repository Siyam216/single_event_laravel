@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>My Tickets</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">My Tickets</li>
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
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Package</th>
                            <th>Payment Id</th>
                            <th>Payment Method</th>
                            <th>Per Ticket Price</th>
                            <th>Total Tickets</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                            <th>Date Time</th>
                            <th style="width:150px;">Action</th>
                        </tr>
                        @foreach($tickets as $ticket)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ticket->package->name }}</td>
                            <td>{{ $ticket->payment_id }}</td>
                            <td>{{ $ticket->payment_method }}</td>
                            <td>{{ $ticket->per_ticket_price }}</td>
                            <td>{{ $ticket->total_tickets }}</td>
                            <td>{{ $ticket->total_price }}</td>
                            <td>
                                @if($ticket->payment_status == 'Pending')
                                <span class="badge badge-danger">Pending</span>
                                @elseif($ticket->payment_status == 'Completed')
                                <span class="badge badge-success">Completed</span>
                                @endif
                            </td>
                            <td>
                                {{ $ticket->created_at }}
                            </td>
                            <td>
                                <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_{{ $loop->iteration }}"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('attendee_invoice',$ticket->id) }}" class="btn btn-success btn-sm pl_10 pr_10"><i class="fa fa-info"></i></a>
                            </td>
                            <div class="modal fade" id="modal_{{ $loop->iteration }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw600">Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb_15">
                                                <div class="col-md-4">User Name: </div>
                                                <div class="col-md-8">{{ $ticket->user->name }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">User Email: </div>
                                                <div class="col-md-8">{{ $ticket->user->email }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing Name: </div>
                                                <div class="col-md-8">{{ $ticket->billing_name }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing Email: </div>
                                                <div class="col-md-8">{{ $ticket->billing_email }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing Phone: </div>
                                                <div class="col-md-8">{{ $ticket->billing_phone }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing Address: </div>
                                                <div class="col-md-8">{{ $ticket->billing_address }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing Country: </div>
                                                <div class="col-md-8">{{ $ticket->billing_country }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing State: </div>
                                                <div class="col-md-8">{{ $ticket->billing_state }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing City: </div>
                                                <div class="col-md-8">{{ $ticket->billing_city }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Billing Zip: </div>
                                                <div class="col-md-8">{{ $ticket->billing_zip }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Payment Method: </div>
                                                <div class="col-md-8">{{ $ticket->payment_method }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Payment Currency: </div>
                                                <div class="col-md-8">{{ $ticket->payment_currency }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Transaction Id: </div>
                                                <div class="col-md-8">{{ $ticket->transaction_id }}</div>
                                            </div>
                                            <div class="divider-1"></div>
                                            <div class="row mb_15">
                                                <div class="col-md-4">Bank Transaction Info: </div>
                                                <div class="col-md-8">{{ $ticket->bank_transaction_info }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection