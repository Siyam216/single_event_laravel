@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Contact Page Information</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_contact_page_update') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ $page_data->address }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $page_data->phone }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" value="{{ $page_data->email }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Map (iframe code)</label>
                                    <textarea name="map" class="form-control h_200" cols="30" rows="10">{{ $page_data->map }}</textarea>
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