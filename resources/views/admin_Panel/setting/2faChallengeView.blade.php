@include('admin_Panel.layout.header')

<div class="setting-wrapper">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header border-bottom text-center"> <h4 style="font-size: 1.6rem;">Two Factor Recovery Challenge</h4></div>

                    <div class="card-body">
                        <p class="text-center"> {{ __('Please enter your authentication code for continue.') }} </p>


                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="code" class="col-md-3 col-form-label text-md-end">{{ __('Authetication Code :') }}</label>

                                <div class="col-md-9">
                                    <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" required autocomplete="code">

                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header border-bottom text-center"> <h4 style="font-size: 1.6rem;">Two Factor Recovery Code</h4></div>
                    <div class="card-body">
                        <p class="text-center"> {{ __('Please enter your authentication recovery code for continue.') }} </p>
                        <form method="POST" action="{{ route('two-factor.login') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="recovery_code" class="col-md-3 col-form-label text-md-end">{{ __('Authetication Recovery Code :') }}</label>

                                <div class="col-md-9">
                                    <input id="recovery_code" type="text" class="form-control @error('recovery_code') is-invalid @enderror" name="recovery_code" required autocomplete="recovery_code">

                                    @error('recovery_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin_Panel.layout.footer')
