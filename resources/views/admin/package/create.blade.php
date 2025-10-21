@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Create Package</h1>
            <div class="section-header-button">
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary">View All</a>
            </div>
        </div>
       
        <div class="section-body">
            <form id="dynamicForm" action="{{ route('admin_package_store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Price *</label>
                                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Maximum Tickets *</label>
                                    <input type="text" class="form-control" name="maximum_tickets" value="{{ old('maximum_tickets') }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Order *</label>
                                    <input type="text" class="form-control" name="item_order" value="{{ old('item_order') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5>Facilities</h5>
                                <button type="button" class="btn btn-warning btn-sm mb-2" id="addRowButton">Add Row</button>
                                <div class="item mb-2">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="facility[]" placeholder="Facility Name Here">
                                        </div>
                                        <div class="col-md-3">
                                            <select name="status[]" class="form-select">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="order[]" placeholder="Order">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger del"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div id="newItemHere"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label class="form-label"></label>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
    $(document).ready(function() {
        $('#addRowButton').click(function() {
            var newRow = $('<div class="item mb-2"><div class="row"><div class="col-md-5"><input type="text" class="form-control" name="facility[]" placeholder="Facility Name Here"></div><div class="col-md-3"><select name="status[]" class="form-select"><option value="Yes">Yes</option><option value="No">No</option></select></div><div class="col-md-2"><input type="text" class="form-control" name="order[]" placeholder="Order"></div><div class="col-md-2"><button type="button" class="btn btn-danger del"><i class="fas fa-trash"></i></button></div></div></div>');
            $('#newItemHere').append(newRow);
        });
        $(document).on('click', '.del', function() {
            $(this).closest('.item').remove();
        });
    });
</script>
@endsection