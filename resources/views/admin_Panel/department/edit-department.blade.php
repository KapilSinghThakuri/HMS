@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-6">
                    <h4 class="page-title">Edit Department</h4>
                </div>
                <div class="col-lg-6 text-right">
                    <a class="btn btn-primary btn-rounded" href="{{ route('department.index')}}"><i class="fa fa-eye" aria-hidden="true"></i>View List</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('department.update',['department' => $departments->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
						<div class="form-group">
							<label>Department Name</label>
							<input class="form-control" name="dept_name" type="text" value="{{ $departments->department_name }}">
						</div>
                        <div class="form-group">
                            <label>Department Code</label>
                            <input class="form-control" name="dept_code" type="text" value="{{ $departments->department_code }}">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea cols="30" rows="4" name="dept_desc" class="form-control">{{ $departments->department_desc }}</textarea>
                        </div>
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Save Department</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection