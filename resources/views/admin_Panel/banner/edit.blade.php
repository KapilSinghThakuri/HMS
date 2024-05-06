<!-- albums.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('banner.index'))
@section('title', 'Banners')
@section('action', 'Edit Banner')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('banner.index'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')

            {!! Form::open(['route' => ['banner.update', 'banner'=>$banner->id ], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('banner_title', 'Banner Title') }} <span class="text-danger">*</span>
                            {{ Form::text('banner_title', $banner->banner_title, ['class' => 'form-control', 'placeholder' => 'Enter Banner Title']) }}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            {{ Form::label('banner_image', 'Banner Image') }} <span class="text-danger">*</span>
                            {{ Form::file('banner_image', null, ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <div class="text-center">
                        {{ Form::submit('Update Banner', ['class' => 'btn btn-primary btn-lg']) }}
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
