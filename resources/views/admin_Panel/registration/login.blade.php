@extends('admin_Panel.registration.layout.main')
@section('content')
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
                @if ($errors->has('email'))
                <div class="d-flex justify-content-center">
                    <div class="account-center alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                </div>
                @endif
				<div class="account-box">
                    <form action="{{ route('login.authenticate')}}" method="POST" class="form-signin">
                        @csrf
						<div class="account-logo">
                            <a href="{{ route('login.index') }}"><img src="{{ asset('admin_Assets/img/logo-dark.png') }}" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Username or Email</label>
                            <input type="text" name="email" autofocus="" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group text-right">
                            <a href="#">Forgot your password?</a>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="{{ route('register.index')}}">Register Now</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
@endsection