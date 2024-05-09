@extends('website.layout.main')
@section('Main-container')
@inject('gallery_category_helper','App\Helpers\GalleryCategoryHelper')

<section id="gallery" class="gallery" style="margin-top: 100px;">

  <div class="container-fluid">
    <div class="section-title">
      <h2>{{ __('index.patient_care_gallery_title')}}</h2>
      <p>{{ __('index.gallery')}}</p>
    </div>
    <div class="row g-0">
      @foreach( $gallery_category_helper->getPatientCarePhotos() as $photo)
      <div class="col-lg-3 col-md-4">
        <div class="gallery-item p-1">
          <a href="{{ asset( $photo->file ) }}" class="galelry-lightbox">
            <img src="{{ asset( $photo->file ) }}" alt="" class="img-fluid">
          </a>
        </div>
      </div>
      @endforeach
    </div>
    <div class="section-title mt-3">
      <h2>{{ __('index.staff_teams_gallery_title')}}</h2>
      <p>{{ __('index.gallery')}}</p>
    </div>
    <div class="row g-0">
      @foreach( $gallery_category_helper->getStaffTeamsPhotos() as $photo)
      <div class="col-lg-3 col-md-4">
        <div class="gallery-item">
          <a href="{{ asset( $photo->file ) }}" class="galelry-lightbox">
            <img src="{{ asset( $photo->file ) }}" alt="" class="img-fluid">
          </a>
        </div>
      </div>
      @endforeach
    </div>
    <div class="section-title mt-3">
      <h2>{{ __('index.staff_teams_gallery_title')}}</h2>
      <p>{{ __('index.gallery')}}</p>
    </div>
    <div class="row g-0">
      @foreach( $gallery_category_helper->getHospitalHistoryPhotos() as $photo)
      <div class="col-lg-3 col-md-4">
        <div class="gallery-item">
          <a href="{{ asset( $photo->file ) }}" class="galelry-lightbox">
            <img src="{{ asset( $photo->file ) }}" alt="" class="img-fluid">
          </a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

@endsection