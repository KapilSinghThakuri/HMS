@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Add Schedule</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="{{ route('my-schedule.index')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-eye"></i> View Schedule</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form action="" method="">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Schedule Date</label>
                                <input name="in"  class="form-control" type="date" id="schedule_date">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Time</label>
                                <input type="time" name="from" class="form-control" id="start_time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Time</label>
                                <input type="time" name="to" class="form-control" id="end_time">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="display-block">Schedule Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="doctor_active" value="option1" checked>
                                    <label class="form-check-label" for="doctor_active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="doctor_inactive" value="option2">
                                    <label class="form-check-label" for="doctor_inactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea cols="30" name="message" rows="4" class="form-control"></textarea>
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
@endsection