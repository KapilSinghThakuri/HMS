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
                    <a href="{{ route('gallery.index')}}" class="btn btn-danger btn-rounded"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="card">
                        <img src="photo1.jpg" class="card-img-top" alt="Description of Photo 1" data-toggle="modal" data-target="#photoModal1">
                        <div class="card-body">
                            <h5 class="card-title">Photo 1</h5>
                            <p class="card-text">Caption for Photo 1</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- {!! Form::open(['route' => 'gallery.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('gallery_category_id', 'Select Album Category ') }}<span class="text-danger">*</span>
                            {!! Form::select('gallery_category_id', $album_category_helper->dropdown(), null, ['class'=>'form-select form-control','placeholder' => 'Select Album Category','id' => 'album_category_id']) !!}
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('photos', 'Choose Photos') }}<span class="text-danger">*</span>
                            {{ Form::file('photos[]', null, ['class' => 'form-control', 'multiple', 'id' => 'photos_input']) }}
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    {{ Form::submit('Upload Photos',['class' => 'btn btn-primary btn-lg']) }}
                </div>
            {!! Form::close() !!} -->
        </div>
    </div>
</div>
@endsection
