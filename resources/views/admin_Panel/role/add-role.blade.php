@extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content">
                <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                    <div class="col-sm-6">
                        {{ Breadcrumbs::render() }}
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('role.index') }}" class="btn btn-danger btn-rounded"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <form method="POST" action="{{ route('role.store')}}">
                            @csrf
                            <div class="form-group">
                                <label>Role Name <span class="text-danger">*</span></label>
                                <input class="form-control" name="name" type="text">
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="submit" class="btn btn-primary submit-btn">Create Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection