@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Ticket</h1>
        </div>
       
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_setting_ticket_submit') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label class="form-label">Purchase Expire Date *</label>
                                            <input type="text" name="ticket_purchase_expire_date" class="form-control" value="{{ $setting->ticket_purchase_expire_date }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection