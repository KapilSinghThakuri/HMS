 <!-- create-album.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')

@section('title_link', route('album.index'))
@section('title', 'Album')
@section('action', 'Create Album')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('album.index'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')
            <div class="row">
                <div class="col-lg-12">
                    <style type="text/css">
                        .form-group label {
                            color: black;
                        }
                    </style>
                    {!! Form::open(['route' => 'album.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

                        @csrf

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('display_order', 'Display Order') }} <span class="text-danger">*</span>
                                    {{ Form::text('display_order', null, ['class' => 'form-control', 'placeholder' => 'Display Order']) }}
                                    @error('display_order')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('album_title', 'Album Title') }} <span class="text-danger">*</span>
                                    {{ Form::text('album_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Album Title']) }}
                                    @error('album_title')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('status', 'Status') }} <span class="text-danger">*</span>
                                    <div>
                                        {{ Form::radio('status', 'active', true) }} Active
                                    </div>
                                    <div>
                                        {{ Form::radio('status', 'inactive', false) }} Inactive
                                    </div>
                                    @error('status')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('album_cover', 'Album Cover') }}
                                    {{ Form::file('album_cover', null, ['class' => 'form-control']) }}
                                    @error('album_cover')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            {{ Form::submit('Create Album',['class' => 'btn btn-primary btn-lg']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection