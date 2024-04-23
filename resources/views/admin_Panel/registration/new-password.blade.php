@extends('admin_Panel.registration.layout.main')
@section('content')
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                     @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-signin" action="{{ route('password.update')}}" method="POST">
                        @csrf
                        <div class="account-logo">
                            <a href="#"><img src="{{ asset('admin_Assets/img/logo-dark.png')}}" alt=""></a>
                        </div>
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <label>Enter Your Email</label>
                            <input type="text" name="email" class="form-control" value="{{ $request->email }}" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Enter New Password</label>
                            <input type="password" name="password" class="form-control" autofocus>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" autofocus>
                        </div>
                        <div class="form-group text-center">
                            <button class="btn btn-primary account-btn" type="submit">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection