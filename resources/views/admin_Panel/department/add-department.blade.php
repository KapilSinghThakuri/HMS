@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Department</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" action="{{ route('department.store') }}">
                        @csrf
						<div class="form-group">
							<label>Department Name</label>
							<input name="dept_name" value="{{ old('dept_name')}}" class="form-control" type="text">
                            @error('dept_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="form-group">
                            <label>Department Code</label>
                            <input name="dept_code" value="{{ old('dept_code')}}" class="form-control" type="text">
                            @error('dept_code')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea cols="30" rows="4" name="dept_desc" value="{{ old('dept_desc')}}" class="form-control"></textarea>
                            @error('dept_desc')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Create Department</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection