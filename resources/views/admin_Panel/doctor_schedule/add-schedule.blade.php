@extends('admin_Panel.layout.main')
@section('Main-container')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Add Schedule</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('schedule.index')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-ban"></i> Cancel</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('schedule.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Doctor</label>
                                <select name="doctor_id" class="form-control">
                                    <option disabled selected>Select Doctor</option>
                                    @foreach($doctors as $doctor)
                                    <option value="{{$doctor->id}}">{{ $doctor->first_name }}{{ $doctor->middle_name }}{{ $doctor->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('doctor_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Schedule Date</label>
                                <input name="in"  class="form-control" placeholder="Select Your Date" id="schedule_date" value="{{ old('in')}}">
                                @error('in') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input name="from" class="form-control" id="start_time" placeholder="Select Start Time" value="{{ old('from')}}">
                                @error('from') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Time</label>
                                <input name="to" class="form-control" id="end_time" placeholder="Select End Time" value="{{ old('to')}}">
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
