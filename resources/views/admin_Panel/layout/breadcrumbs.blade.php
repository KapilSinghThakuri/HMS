<!-- breadcrumbs.blade.php -->
<div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
    <div class="col-sm-8">
      <a href="{{ route('admin.dashboard')}}"> Dashboard </a> <i class="fa fa-angle-right" aria-hidden="true"></i>
    </div>
    <div class="col-sm-4 text-right">
        @yield('button')
    </div>
</div>