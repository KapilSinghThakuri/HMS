@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('user.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Username<span class="text-danger">*</span></label>
                                    <input name="username" value="{{ old('username')}}" class="form-control" type="text">
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input name="email" value="{{ old('email')}}" class="form-control" type="text">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Phone<span class="text-danger">*</span></label>
                                    <input name="phone" value="{{ old('phone')}}" class="form-control" type="text">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <input name="address" value="{{ old('address')}}" class="form-control" type="text">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Password<span class="text-danger">*</span></label>
                                    <input name="password" value="{{ old('password')}}" class="form-control" type="password">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Confirm Password<span class="text-danger">*</span></label>
                                    <input name="password_confirmation" value="{{ old('password_confirmation')}}" class="form-control" type="password">
                                    @error('password_confirmation')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Select Roles<span class="text-danger">*</span></label>
                                    @foreach($roles as $role)
                                    <input type="checkbox" value="{{ $role }}" name="roles[]">
                                    <label class="mr-2">{{ $role }}</label>
                                    @endforeach

                                   <!-- select class="form-control select2" multiple name="roles[]">
                                        <option value="" disabled>Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select> -->

                                </div>
                            </div>
                        </div>

                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Create User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection