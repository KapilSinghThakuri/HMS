@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Edit Department</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
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