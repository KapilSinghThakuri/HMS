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
                    <a href="{{ route('banner.create')}}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Banner</a>
                </div>
            </div>
            <div class="row">
                @foreach($banners as $banner)
                <div class="col-md-4">
                    <div class="card">
                        <a href="{{ route('banner.show',['banner' => $banner->id])}}">
                            <img src="{{ asset($banner->banner_image ?? 'https://via.placeholder.com/100x100')}}" alt="Banner Image">
                        </a>
                        <div class="card-body text-center p-0 mt-2">
                            <a href="{{ route('banner.show',['banner' => $banner->id])}}">
                                <h4 class="card-title album-title">{{ $banner->banner_title }}</h4>
                            </a>
                            <div>
                                <a href="{{ route('banner.edit',['banner'=>$banner->id])}}" style="font-size: 18px;" title="Click For Edit"><i class="fa fa-pencil-square-o mr-2" aria-hidden="true"></i></a>
                                <a href="#" data-id="{{ $banner->id }}" data-toggle="modal" data-target="#delete_banner_{{ $banner->id }}" style="font-size: 22px; color: red;" title="Click For Delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="delete_banner_{{ $banner->id }}" class="modal fade delete-modal" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <img src="{{ asset('admin_Assets/img/sent.png')}}" alt="" width="50" height="46">
                                <h3>Are you sure want to delete this Banner?</h3>
                                <div class="m-t-20 d-flex justify-content-center"> <a href="#" class="btn btn-white mr-2" data-dismiss="modal">Cancel</a>
                                    <form action="{{ route('banner.destroy', ['banner' => $banner->id]) }}" method="POST">
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
        </div>
    </div>
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
          transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 150px;
        }

        .card .card-content {
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
        }

        .card .card-title {
            font-size: 18px;
            font-weight: 400;
            margin: 0;
        }
    </style>
@endsection
