@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Facility</h1>
            {{-- <div class="section-header-button">
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary">View All</a>
            </div> --}}
        </div>
       
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_package_facility_update',$package_facility->id) }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $package_facility->name }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Status *</label>
                                    <select name="status" class="form-select">
                                        <option value="Yes" {{ $package_facility->status == 'Yes' ? 'selected' : '' }}>Yes</option>
                                        <option value="No" {{ $package_facility->status == 'No' ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Item Order *</label>
                                    <input type="text" class="form-control" name="item_order" value="{{ $package_facility->item_order }}">
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