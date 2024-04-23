@extends('admin_Panel.registration.layout.main')
@section('content')
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    @if(session('success'))
                    <div class="col-md-12 d-flex justify-content-center">
                        <span class="form-group alert alert-success">{{ session('success')}} </span>
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('login')}}" method="POST" class="form-signin">
                        @csrf
						<div class="account-logo">
                            <a href="{{ route('login') }}"><img src="{{ asset('admin_Assets/img/logo-dark.png') }}" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Username or Email</label>
                            <input type="text" name="email" autofocus="" class="form-control">
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                <label class="custom-control-label" for="remember">Remember Me</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-muted">Forgot your password?</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="{{ route('register')}}">Register Now</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
@endsection