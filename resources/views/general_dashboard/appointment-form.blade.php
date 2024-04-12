<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- Include Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<!-- Include Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('appointment.store', ['doctorId' => $doctorId, 'scheduleId' => $scheduleId]) }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <h2 class="page-title border-bottom">Appointment Form</h2>
                    </div>
                    <div class="col-lg-6">
                        <a class="btn btn-primary btn-rounded float-end" href="{{ route('general.dashboard')}}"><i class="fa fa-eye" aria-hidden="true"></i>Cancel</a>
                    </div>
                </div>
                <div class="row">
                    <!-- @if ($errors->any())
                    <div class="col-sm-12">
                        <div class="form-group alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li class="">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif -->
                    <!-- Form field validations -->
                    <div class="col-sm-12">
                        <div id="inputErrors" class="form-group"></div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Full Name: <span class="text-danger">*</span></label>
                                    <input name="fullname" id="full_name" value="{{ old('full_name')}}" class="form-control" type="text" placeholder="Enter your full name" autofocus>
                                    @error('full_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Date of Birth: <span class="text-danger">*</span></label>
                                    <input name="date_of_birth" placeholder="Select Your DOB" id="date_of_birth" class="form-control">
                                    @error('date_of_birth')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group gender-select">
                                    <label class="gen-label">Gender: <span class="text-danger">*</span></label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input id="male" type="radio" name="gender" class="form-check-input" value="Male">Male
                                            @error('male')<span class="text-danger">{{ $message }}</span>@enderror
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input id="female" type="radio" name="gender" class="form-check-input" value="Female">Female
                                            @error('female')<span class="text-danger">{{ $message }}</span>@enderror
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input id="other" type="radio" name="gender" class="form-check-input" value="Other">Other
                                            @error('other')<span class="text-danger">{{ $message }}</span>@enderror
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Phone: <span class="text-danger">*</span></label>
                                    <input id="phone" name="phone" value="{{ old('phone')}}" class="form-control" type="text" placeholder="Enter your phone">
                                    @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Email: <span class="text-danger">*</span></label>
                                    <input id="email" name="email" class="form-control" value="{{ old('email')}}" type="email" placeholder="Enter your email address">
                                    @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>

                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Parents Name:</label>
                                    <input name="parents_name" id="parents_name" value="{{ old('parents_name')}}" class="form-control" type="text" autofocus placeholder="Enter your parent's name">
                                    @error('parents_name')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Permanent Address: <span class="text-danger">*</span></label>
                                    <input name="permanent_address" id="permanent_address" value="{{ old('permanent_address')}}" class="form-control" type="text" placeholder="Enter your full address">
                                    @error('permanent_address')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Temporary Address:</label>
                                    <input name="temporary_address" id="temporary_address" value="{{ old('temporary_address')}}" class="form-control" type="text" placeholder="Enter your full address">
                                    @error('temporary_address')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <div class="form-group">
                                    <label>Medical History:</label>
                                    <input type="file" name="medical_history" value="" class="form-control">
                                    @error('medical_history')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Reason:<span class="text-danger">*</span></label>
                                    <textarea name="reason" class="form-control" rows="5" cols="20">{{ old('reason')}}</textarea>
                                    @error('reason')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label>Appointment Message:</label>
                                    <textarea name="appointment_message" class="form-control" rows="5" cols="20">{{ old('appointment_message')}}</textarea>
                                    @error('appointment_message')<span class="text-danger">{{ $message }}</span>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-t-20 text-center mt-3">
                    <button type="submit" class="btn btn-primary">Create Appointment</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#date_of_birth", {
            dateFormat: "Y-m-d",
        });
    });
</script>

