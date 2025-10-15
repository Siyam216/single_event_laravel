@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Home Banner Information</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_home_banner_update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Existing Background</label>
                                    <div><img src="{{ asset('uploads/'.$home_banner->background) }}" alt="" class="w_200"></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Change Background</label>
                                    <div><input type="file" name="background"></div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Heading *</label>
                                    <input type="text" class="form-control" name="heading" value="{{ $home_banner->heading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Subheading *</label>
                                    <input type="text" class="form-control" name="subheading" value="{{ $home_banner->subheading }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Text</label>
                                    <textarea name="text" class="form-control h_100" cols="30" rows="10">{{ $home_banner->text }}</textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Event Date *</label>
                                            <input type="text" class="form-control" name="event_date" value="{{ $home_banner->event_date }}">(Format: mm/dd/yyyy)
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Event Time *</label>
                                            <input type="text" class="form-control" name="event_time" value="{{ $home_banner->event_time }}">(Format: HH:MM:SS)
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