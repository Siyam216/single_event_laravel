@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Favicon</h1>
        </div>
       
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_setting_favicon_submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Existing Favicon</label>
                                    <div><img src="{{ asset('uploads/'.$setting->favicon) }}" alt="" class="w_50"></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Change Favicon</label>
                                    <div><input type="file" name="favicon"></div>
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