<!-- albums.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('banner.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

            {!! Form::open(['route' => 'banner.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @csrf
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('banner_title', 'Banner Title') }} <span class="text-danger">*</span>
                        {{ Form::text('banner_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Banner Title']) }}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        {{ Form::label('banner_image', 'Banner Image') }} <span class="text-danger">*</span>
                        {{ Form::file('banner_image', null, ['class' => 'form-control']) }}
                    </div>
                </div>
                <div class="col-lg-12 text-center">
                    {{ Form::submit('Create Banner', ['class' => 'btn btn-primary btn-lg']) }}
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>

@endsection
