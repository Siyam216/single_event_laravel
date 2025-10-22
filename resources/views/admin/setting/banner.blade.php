@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Banner</h1>
        </div>
       
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_setting_banner_submit') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Existing Banner</label>
                                    <div><img src="{{ asset('uploads/'.$setting->banner) }}" alt="" class="w_300"></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Change Banner</label>
                                    <div><input type="file" name="banner"></div>
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