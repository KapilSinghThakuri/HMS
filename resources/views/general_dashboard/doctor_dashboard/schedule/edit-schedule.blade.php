@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Edit Schedule</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('my-schedule.index')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-eye"></i> View Schedule</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('my-schedule.store') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Schedule Date</label>
                                <input name="in"  class="form-control" value="{{ $date }}" placeholder="Select Your Date" id="schedule_date">
                                @error('in') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input name="from" class="form-control" id="start_time" value="{{ $start_time }}" placeholder="Select Start Time">
                                @error('from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Time</label>
                                <input name="to" class="form-control" id="end_time" value="{{ $end_time }}" placeholder="Select End Time">
                                @error('to') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="display-block">Schedule Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="doctor_active" value="Active" checked>
                                    <label class="form-check-label" for="doctor_active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="Inactive">
                                    <label class="form-check-label" for="doctor_inactive">
                                        Inactive
                                    </label>
                                </div>
                                @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="m-t-20 text-center">
                        <button type="submit" class="btn btn-primary schedule_submit">Create Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        flatpickr("#schedule_date", {
            dateFormat: "Y-m-d",
        });
        flatpickr("#start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
        flatpickr("#end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
</script>
@endsection