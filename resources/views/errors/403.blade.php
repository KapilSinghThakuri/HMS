@extends('errors.layout.main')

@section('content')
<div class="main-wrapper error-wrapper">
    <div class="error-box">
        <h1>403</h1>
        <h3><i class="fa fa-warning"></i> Oops! Forbidden!</h3>
        <p>The page you requested was not found.</p>
        <a href="{{ route('admin.dashboard')}}" class="btn btn-primary go-home">Go to Home</a>
    </div>
</div>
@endsection