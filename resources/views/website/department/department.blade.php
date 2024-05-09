@extends('website.layout.main')
@section('Main-container')
@inject('department_helper','App\Helpers\DepartmentHelper')

<section id="services" class="services" style="margin-top: 100px;">
    <div class="container">

        <div class="section-title">
          <h2>@lang('index.department_title')</h2>
          <p>{{ __('index.department')}}</p>
        </div>

        <div class="row">
          @foreach($department_helper->getAllDepartment() as $department)
          <div class="col-lg-4 col-md-6 p-3">
            <div class="icon-box">
              <div class="icon">
                 <i class="{{ $department_helper->getDepartmentIcon($department->department_name) }}"></i>
              </div>
              <h4><a href="">{{ $department->department_name }}</a></h4>
              <p>{!! Str::limit($department->department_desc, 85, '...') !!}</p>
            </div>
          </div>
          @endforeach
        </div>
    </div>
</section>
@endsection