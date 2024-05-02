 <!-- create-album.blade.php -->
 @extends('admin_Panel.layout.main')
@section('Main-container')
    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('album.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <style type="text/css">
                        .form-group label {
                            color: black;
                        }
                    </style>
                    {!! Form::open(['route' => ['album.update', $album->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        @method('PUT')
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('display_order', 'Display Order') }} <span class="text-danger">*</span>
                                    {{ Form::text('display_order', $album->display_order , ['class' => 'form-control', 'placeholder' => 'Display Order']) }}
                                    @error('display_order')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('album_title', 'Album Title') }} <span class="text-danger">*</span>
                                    {{ Form::text('album_title', $album->album_title, ['class' => 'form-control', 'placeholder' => 'Enter Album Title']) }}
                                    @error('album_title')<span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    {{ Form::label('status', 'Status') }} <span class="text-danger">*</span>
                                    <div>
                                        {{ Form::radio('status', 'active',  $album->status === 'active' ?? true) }} Active
                                    </div>
                                    <div>
                                        {{ Form::radio('status', 'inactive',  $album->status === 'Inactive' ?? true) }} Inactive
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
                            {{ Form::submit('Update Album',['class' => 'btn btn-primary btn-lg']) }}
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection