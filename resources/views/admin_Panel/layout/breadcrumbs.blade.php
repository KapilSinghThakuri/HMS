<div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
    <div class="col-lg-8">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="@yield('title_link', '#')">@yield('title')</a>
            </li>
            @hasSection('action')
            <li class="breadcrumb-item active" aria-current="page">@yield('action')</li>
            @endif

            <!-- @foreach(Request::segments() as $segment)
            <li>
                <a href="#">{{$segment}}</a>
            </li>
            @endforeach -->
        </ol>
    </div>
    <div class="col-lg-4 text-right">
        <a href="@yield('button_link', '#')" class="btn btn-primary btn-rounded">
            @yield('button')
        </a>
    </div>
</div>
