@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                  Breadcrumbs...
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('gallery.create')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Album</a>
                </div>
            </div>

            <div class="row">
                @foreach($categories as $album)
                <div class="col-md-3">
                    <a href="{{ route('gallery.create',['album_id' => $album->id])}}">
                        <div class="card" id="gallery_album">
                            <img src="https://via.placeholder.com/350" class="card-img-top" alt="Album 1 Cover">
                            <div class="card-body text-center">
                                <h6 class="card-title">{{ $album->album_title }}</h6>
                                <a href="#" class="btn btn-primary">View Album</a>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
