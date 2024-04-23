@extends('admin_Panel.registration.layout.main')
@section('content')
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">

                <div class="row">
                    @error('email')
                    <div class="col-md-12 d-flex justify-content-center">
                        <span class="form-group alert alert-danger">Email not found! Please Provide correct email address.</span>
                    </div>
                    @enderror
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="account-box">
                    <form class="form-signin" action="{{ route('password.email')}}" method="POST">
                        @csrf
						<div class="account-logo">
                            <a href="{{ route('password.request')}}"><img src="{{ asset('admin_Assets/img/logo-dark.png')}}" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" name="email" class="form-control" autofocus>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                        </div>
                        <div class="text-center register-link">
                            <a href="{{ route('login') }}">Back to Login</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
@endsection