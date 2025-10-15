@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Footer</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_setting_footer_submit') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Copyright Information *</label>
                                    <input type="text" name="copyright" class="form-control" value="{{ $setting->copyright }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Address</label>
                                    <input type="text" name="footer_address" class="form-control" value="{{ $setting->footer_address }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="footer_email" class="form-control" value="{{ $setting->footer_email }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="footer_phone" class="form-control" value="{{ $setting->footer_phone }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Facebook</label>
                                    <input type="text" name="footer_facebook" class="form-control" value="{{ $setting->footer_facebook }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Twitter</label>
                                    <input type="text" name="footer_twitter" class="form-control" value="{{ $setting->footer_twitter }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Linkedin</label>
                                    <input type="text" name="footer_linkedin" class="form-control" value="{{ $setting->footer_linkedin }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Instagram</label>
                                    <input type="text" name="footer_instagram" class="form-control" value="{{ $setting->footer_instagram }}">
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