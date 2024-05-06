<!-- view-album.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')
@inject('album_category_helper', 'App\Helpers\GalleryCategoryHelper')

@section('title_link', route('album.index'))
@section('title', 'Album')
@section('action', 'Gallery')
@section('button')
    <i class="fa fa-chevron-left" aria-hidden="true"></i> Back
@endsection
@section("button_link", route('album.index'))
    <div class="page-wrapper">
        <div class="content">
            @include('admin_Panel.layout.breadcrumbs')

            <div class="row">
                @foreach($photos as $photo)
                <div class="col-md-3">
                    <div class="photo-card">
                        <img src="{{ asset( $photo->file ?? 'https://via.placeholder.com/150')}}" alt="photo_gallery">
                        <div class="delete-button text-center">
                            <a href="#"
                               data-id="{{ $photo->id }}"
                               data-toggle="modal"
                               data-target="#delete_photo_{{ $photo->id }}"
                               style="font-size: 20px; color: red;"
                               title="Click to Delete">
                               <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div id="delete_photo_{{ $photo->id }}" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                <h3>Are you sure want to delete this Photo?</h3>
                                <div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Cancel</a>
                                    <form action="{{ route('gallery.destroy', ['gallery' => $photo->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <form method="POST" action="{{ route('gallery.store')}}" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="gallery_category_id" value="{{ request()->route('album') }}">
                <input type="hidden" id="file_type" name="file_type" value="">
                <div class="row mt-5">
                    <div class="col-lg-3">
                        <div class="form-group">
                            {{ Form::label('display_order', 'Display Order') }} <span class="text-danger">*</span>
                            {{ Form::text('display_order', null, ['class' => 'form-control', 'placeholder' => 'Display Order']) }}
                            @error('display_order')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-lg-2">
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
                    <div class="col-md-3">
                        <div class="form-group d-flex flex-column">
                            <div>
                                {{ Form::label('file type', 'Select File Type') }} <span class="text-danger">*</span>
                            </div>
                            <div class="d-flex mt-1">
                                <span class="btn btn-primary btn-sm" id="image"><i class="fa fa-file-image-o" aria-hidden="true"></i> Image</span>
                                <span class="btn btn-primary btn-sm ml-2" id="video"><i class="fa fa-video-camera" aria-hidden="true"></i> Video</span>
                                @error('file_type')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-none" id="image_input_field">
                        <div class="form-group">
                            <div class="add-photo-card">
                                <p id="photosInfo">+ Add New Photo</p>
                                <input type="file" name="file" id="upload-photo" onchange="handleFileChange(event)">
                                @error('file')<span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="ml-3 mt-1 float-right">
                                {{ Form::submit('Submit', ['class' => 'btn btn-success btn-md']) }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-none" id="video_input_field">
                        <div class="form-group">
                            {{ Form::label('video link', 'Put Video URL') }} <span class="text-danger">*</span>
                            {{ Form::text('file', null, ['class' => 'form-control', 'placeholder' => 'Put Video URL']) }}
                            @error('file')<span class="text-danger">{{ $message }}</span> @enderror
                            <div class="float-right mt-1">
                                {{ Form::submit('Submit', ['class' => 'btn btn-success btn-md']) }}
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            function handleFileChange(event) {
                    const file = event.target.files[0];
                    if (file) {
                        $('#photosInfo').text(`${file.name}`);
                    }
                }
            $(document).ready(function () {
                $('#image').on("click", function (event) {
                    event.preventDefault();
                    console.log('Image');
                    $('#image_input_field').removeClass('d-none').show();
                    $('#video_input_field').addClass('d-none').hide();
                    $('#file_type').val('image');
                })
                $('#video').on("click", function (event) {
                    event.preventDefault();
                    console.log('video');
                    $('#video_input_field').removeClass('d-none').show();
                    $('#image_input_field').addClass('d-none').hide();
                    $('#file_type').val('video');
                })
            });
        </script>
    </div>
</div>
@endsection
