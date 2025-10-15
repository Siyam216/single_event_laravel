@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Create Schedule Day</h1>
            <div class="section-header-button">
                <a href="{{ route('admin_schedule_day_index') }}" class="btn btn-primary">View All</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_schedule_day_store') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Day *</label>
                                    <input type="text" class="form-control" name="day" value="{{ old('day') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Date *</label>
                                    <input type="text" class="form-control" name="date1" value="{{ old('date1') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Order *</label>
                                    <input type="text" class="form-control" name="order1" value="{{ old('order1') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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