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
                    <a href="{{ route('album.create')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Album</a>
                </div>
            </div>

            <div class="row">
                @foreach($categories as $album)
                <div class="col-md-3">
                    <div class="card m-0" id="gallery_album">
                        <a href="{{ route('album.show',['album' => $album->id])}}">
                            <img src="{{ asset($album->album_cover ?? 'https://via.placeholder.com/350') }}" class="card-img-top" alt="Album 1 Cover">
                        </a>
                        <div class="card-body text-center p-0">
                            <a href="{{ route('album.show',['album' => $album->id])}}">
                                <h4 class="card-title album-title">{{ $album->album_title }}</h4>
                            </a>
                            <div>
                                <a href="#" style="font-size: 18px;" title="Click For Edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                <a href="#" data-id="{{ $album->id }}" data-toggle="modal" data-target="#delete_album" style="font-size: 22px; color: red;" title="Click For Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
