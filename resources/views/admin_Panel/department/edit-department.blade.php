@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                   <a class="btn btn-danger btn-rounded" href="{{ route('department.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('department.update',['department' => $departments->id]) }}" method="POST">
                        @method('PUT')
                        @csrf
						<div class="form-group">
							<label>Department Name</label>
							<input class="form-control" name="department_name" type="text" value="{{ $departments->department_name }}">
                            @error('department_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
						</div>
                        <div class="form-group">
                            <label>Department Code</label>
                            <input class="form-control" name="department_code" type="text" value="{{ $departments->department_code }}">
                            @error('department_code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <style type="text/css">
                              .ck.ck-editor__main div {
                                height: 200px;
                            }
                        </style>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea cols="30" id="editor" rows="4" name="department_desc" class="form-control">{{ $departments->department_desc }}</textarea>
                            @error('department_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
<script type="text/javascript">
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );
</script>
@endsection