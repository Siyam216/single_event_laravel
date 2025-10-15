@extends('admin.layout.master')
@section('main_content')
@include('admin.layout.nav')
@include('admin.layout.sidebar')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Assign Schedule to Speaker</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin_speaker_schedule_store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Speakers *</label>
                                            <select name="speaker_id" class="form-select">
                                                @foreach ($speakers as $speaker)
                                                <option value="{{ $speaker->id }}">{{ $speaker->name }} - {{ $speaker->email }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-4">
                                            <label class="form-label">Schedules *</label>
                                            <select name="schedule_id" class="form-select">
                                                @foreach ($schedules as $schedule)
                                                <option value="{{ $schedule->id }}">{{ $schedule->title }} - {{ $schedule->schedule_day->day }}, {{ $schedule->schedule_day->date1 }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label"></label>
                                    <button type="submit" class="btn btn-primary">Assign</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-header">
            <h1>Speaker Schedules</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Schedule Title</th>
                                            <th>Day</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pivot_table_data as $row)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $row->speaker_name }}</td>
                                            <td>{{ $row->speaker_email }}</td>
                                            <td>{{ $row->schedule_title }}</td>
                                            <td>
                                                @php
                                                $day = DB::table('schedule_days')->where('id', $row->schedule_id1)->first()->day;
                                                echo $day;
                                                @endphp
                                            </td>
                                            <td>
                                                <a href="{{ route('admin_speaker_schedule_delete',$row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>   
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection