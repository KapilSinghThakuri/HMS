<!-- view-album.blade.php -->
@extends('admin_Panel.layout.main')
@section('Main-container')
@inject('album_category_helper', 'App\Helpers\GalleryCategoryHelper')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('album.index')}}" class="btn btn-danger btn-rounded"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="photo-card">
                        <img src="https://via.placeholder.com/150" alt="Photo 1">
                        <p>Photo Description</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('gallery.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-3 text-center">
                        <input type="hidden" name="gallery_category_id" value="{{ request()->route('album') }}">
                        <div class="add-photo-card">
                            <p id="photosInfo">+ Add New Photo</p>
                            <input type="file" name="file" id="upload-photo" onchange="handleFileChange(event)">
                        </div>
                        <button type="submit" class="btn btn-sm btn-success mt-2">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript">
            function handleFileChange(event) {
                const file = event.target.files[0];
                if (file) {
                    $('#photosInfo').text(`${file.name}`);
                }
            }
        </script>
    </div>
</div>
@endsection
