@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Package</h1>
            <div class="section-header-button">
                <a href="{{ route('admin_package_index') }}" class="btn btn-primary">View All</a>
            </div>
        </div>
       
        <div class="section-body">
            <form action="{{ route('admin_package_update',$package->id) }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="mb-4">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $package->name }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Price *</label>
                                    <input type="text" class="form-control" name="price" value="{{ $package->price }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Maximum Tickets *</label>
                                    <input type="text" class="form-control" name="maximum_tickets" value="{{ $package->maximum_tickets }}">
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Order *</label>
                                    <input type="text" class="form-control" name="item_order" value="{{ $package->item_order }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h5>Existing Facilities</h5>
                                
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm">
                                        @foreach($package_facilities as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->status }}</td>
                                                <td>
                                                    <a href="{{ route('admin_package_facility_edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                                                    <a href="{{ route('admin_package_facility_delete',$item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5>Add Facilities</h5>
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
                            <button type="submit" class="btn btn-primary">Update</button>
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