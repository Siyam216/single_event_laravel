@extends('front.layout.master')

@section('main_content')
<div class="common-banner" style="background-image:url({{ asset('uploads/'.$setting_data->banner) }})">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="item">
                    <h2>Dashboard</h2>
                    <div class="breadcrumb-container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="user-section pt_70 pb_70">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <div class="user-sidebar">
                    <div class="card">
                        @include('front.layout.sidebar')
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <h4 class="mb_15 fw600">User Detail:</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name: </th>
                            <td>{{ Auth::guard('web')->user()->name }}</td>
                        </tr>
                        <tr>
                            <th>Email: </th>
                            <td>{{ Auth::guard('web')->user()->email }}</td>
                        </tr>
                        <tr>
                            <th>Phone: </th>
                            <td>
                                @if(Auth::guard('web')->user()->phone != '')
                                {{ Auth::guard('web')->user()->phone }}
                                @else
                                ---
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Address: </th>
                            <td>
                                @if(Auth::guard('web')->user()->address != '')
                                {{ Auth::guard('web')->user()->address }}
                                @else
                                ---
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>State: </th>
                            <td>
                                @if(Auth::guard('web')->user()->state != '')
                                {{ Auth::guard('web')->user()->state }}
                                @else
                                ---
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>City: </th>
                            <td>
                                @if(Auth::guard('web')->user()->city != '')
                                {{ Auth::guard('web')->user()->city }}
                                @else
                                ---
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Country: </th>
                            <td>
                                @if(Auth::guard('web')->user()->country != '')
                                {{ Auth::guard('web')->user()->country }}
                                @else
                                ---
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Zip Code: </th>
                            <td>
                                @if(Auth::guard('web')->user()->zip != '')
                                {{ Auth::guard('web')->user()->zip }}
                                @else
                                ---
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection