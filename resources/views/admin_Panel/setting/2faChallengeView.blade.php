@extends('admin_Panel.registration.layout.main')
@section('content')

<div class="main-wrapper account-wrapper">
    <div class="account-page">
        <div class="account-center">
            <div class="account-box">
                <div class="card">
                    <div class="account-logo">
                        <a href="#"><img src="{{ asset('admin_Assets/img/logo-dark.png') }}" alt=""></a>
                    </div>
                    <div class="card-header border-bottom text-center"> <h4 style="font-size: 1.3rem;">Two Factor Recovery Code</h4></div>
                    <div class="card-body">
                        <p class="text-center"> {{ __('Please enter your authentication recovery code for continue.') }} </p>
                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="recovery_code">Authetication Recovery Code:</label>
                                <input id="recovery_code" type="text" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" required autofocus autocomplete="recovery_code">
                                @error('recovery_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary account-btn">Submit</button>
                            </div>
                        </form>
                        <div class="text-center register-link">
                            <a href="{{ route('login') }}">Back to Login</a>
                        </div>
                    </div>
                </div>
                <div class="card" style="margin: 0;">
                    <div class="card-header border-bottom text-center"> <h4 style="font-size: 1.3rem;">Two Factor Recovery Challenge</h4></div>
                    <div class="card-body">
                        <p class="text-center">Please enter your authentication code for continue.</p>

                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf
                            <div class="form-group">
                                <label for="code">Authetication Code:</label>
                                <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary account-btn">Submit</button>
                            </div>
                        </form>
                        <div class="text-center register-link">
                            <a href="{{ route('login') }}">Back to Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
