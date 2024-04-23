@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('department.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('department.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Department Name</label>
                                    <input name="department_name" value="{{ old('department_name')}}" class="form-control" type="text">
                                    @error('department_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Department Code</label>
                                    <input name="department_code" value="{{ old('department_code')}}" class="form-control" type="text">
                                    @error('department_code')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <style type="text/css">
                              .ck.ck-editor__main div {
                                height: 200px;
                            }
                        </style>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea cols="30" id="editor" rows="4" name="department_desc" value="{{ old('department_desc')}}" class="form-control"></textarea>
                            @error('department_desc')
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