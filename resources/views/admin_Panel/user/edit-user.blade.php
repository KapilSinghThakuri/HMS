@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-danger btn-rounded" href="{{ route('user.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('user.update',['user'=> $user->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Username<span class="text-danger">*</span></label>
                                    <input name="username" value="{{ $user->username }}" class="form-control" type="text">
                                    @error('username')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Email<span class="text-danger">*</span></label>
                                    <input name="email" value="{{ $user->email}}" class="form-control" type="text">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Phone<span class="text-danger">*</span></label>
                                    <input name="phone" value="{{ $user->phone }}" class="form-control" type="text">
                                    @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <input name="address" value="{{ $user->address }}" class="form-control" type="text">
                                    @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Select Roles<span class="text-danger">*</span></label>
                                    @foreach($roles as $role)
                                    <input type="checkbox" value="{{ $role }}" name="roles[]"  {{ in_array($role, $roleNames) ? 'checked' : '' }}>
                                    <label class="mr-2">{{ $role }}</label>
                                    @endforeach

                                    <!-- <select class="form-control select" name="roles[]" multiple>
                                        <option value="" disabled>Select Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select> -->
                                </div>
                            </div>
                        </div>

                        <div class="m-t-20 text-center">
                            <button type="submit" class="btn btn-primary submit-btn">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection