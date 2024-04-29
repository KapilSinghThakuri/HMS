@extends('errors.layout.main')

@section('content')
<div class="main-wrapper error-wrapper">
    <div class="error-box">
        <h1>500</h1>
        <h3><i class="fa fa-warning"></i> Oops! Server Error!</h3>
        <p>The page you requested was not found.</p>
        <a href="#" class="btn btn-primary go-home">Go to Home</a>
    </div>
</div>
@endsection