@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <!-- <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h4 class="page-title">Add Doctor</h4>
                </div>
            </div> -->
            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <form method="POST" action="{{ route('doctor.update',['doctor' => $doctor_basic->id])}}" id="wizardForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="step1" class="step">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Basic Details</h4>
                                </div>
                            </div>
                            <div class="row">
                                @if ($errors->any())
                                <div class="col-sm-12">
                                    <div class="form-group alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endif
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input name="first_name" id="first_name" value="{{ $doctor_basic->first_name }}" class="form-control" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Middle Name </label>
                                        <input name="middle_name" id="middle_name" value="{{ $doctor_basic->middle_name}}" class="form-control" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input name="last_name" id="last_name" value="{{ $doctor_basic->last_name}}" class="form-control" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Profile</label>
                                        <div class="profile-upload">
                                            <div class="upload-input">
                                                <input type="file" name="profile" value="{{ $doctor_basic->profile}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input name="phone" value="{{ $doctor_basic->phone }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="department_id">
                                            <option disabled > Choose department </option>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id  }}" {{ $related_department->id == $department->id ? 'selected' : '' }}> {{ $department->department_name }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>License Number <span class="text-danger">*</span></label>
                                        <input name="license_no" value="{{ $doctor_exp->license_no }}" type="text" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="dobBS" name="date_of_birth_BS" value="{{ $doctor_basic-> date_of_birth_BS }}" placeholder="Select your DOB" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="date" readonly id="dobAD" name="date_of_birth_AD" value="{{ $doctor_basic-> date_of_birth_AD }}" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group gender-select">
                                        <label class="gen-label">Gender <span class="text-danger">*</span></label>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Male" {{ old('gender') == 'male' ? 'checked' : '' }}>Male
                                            </label>
                                        </div>
                                        <div class="form-check-inline">
                                            <label class="form-check-label">
                                                <input type="radio" name="gender" class="form-check-input" value="Female" {{ old('gender') == 'female' ? 'checked' : '' }}>Female
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="country">
                                            <option disabled selected> Select your country </option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country ->english_name }}" {{ $country->english_name == 'Nepal' ? 'selected' : '' }}>{{ $country ->english_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="district">
                                            <option disabled selected> Select your district </option>
                                            @foreach($districts as $district)
                                            <option value="{{ $district ->district_name }}" {{ old('district') == 'district_name' ? 'selected' : '' }}>{{ $district ->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Province<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="province">
                                            <option disabled selected> Select your Province </option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province -> province_name }}">{{ $province -> province_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Municipality<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="municipality">
                                            <option disabled selected> Select your Municipality </option>
                                            @foreach($municipalities as $municipality)
                                            <option value="{{ $municipality->municipality_name }}">{{ $municipality->municipality_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input name="street" type="text" value="{{ $doctor_addr -> street}}" class="form-control ">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-primary nextBtn">Next</button>
                            </div>
                        </div>

                    <!-- Educational Details -->
                        <div id="step2" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Educational Details</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Institute Name <span class="text-danger">*</span></label>
                                        <input name="institute_name" value="{{ $doctor_edu -> institute_name}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Medical Degree <span class="text-danger">*</span></label>
                                        <input name="medical_degree" value="{{ $doctor_edu -> medical_degree }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="grad_yearBS" value="{{ $doctor_edu -> graduation_year_BS}}" name="graduation_year_BS" placeholder="Select Your Graduation Year" name="grad_year" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input readonly type="date" id="grad_yearAD" name="graduation_year_AD" value="{{ $doctor_edu -> graduation_year_AD}}" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input name="specialization" value="{{ $doctor_edu -> specialization}}" type="text" class="form-control ">
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="button" class="btn btn-primary nextBtn">Next</button>
                            </div>
                        </div>

                        <!-- Experiences Details -->
                        <div id="step3" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Experience Details</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Organization Name <span class="text-danger">*</span></label>
                                        <input name="org_name" value="{{ $doctor_exp->org_name }}" type="text" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[BS] <span class="text-danger">*</span></label>
                                        <input name="start_date_BS" type="dob" value="{{ $doctor_exp->start_date_BS }}" id="start_dateBS" placeholder="Select your start date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" name="start_date_AD" id="start_dateAD" value="{{ $doctor_exp->start_date_AD }}" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[BS] <span class="text-danger">*</span></label>
                                        <input name="end_date_BS" type="dob" id="end_dateBS" value="{{ $doctor_exp->end_date_BS }}" placeholder="Select your end date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" id="end_dateAD" name="end_date_AD" value="{{ $doctor_exp->end_date_AD }}" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea name="job_description" class="form-control" rows="3" cols="30">{{ $doctor_exp->job_description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="button" class="btn btn-primary nextBtn">Next</button>
                            </div>
                        </div>

                    <!-- User & password details -->
                        <div id="step4" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Account Credentials</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" class="form-control" value="{{ $doctor_basic->email }}" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input name="password" class="form-control" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input name="password_confirmation" class="form-control" type="password">
                                    </div>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="submit" class="btn btn-primary">Update Doctor</button>
                                <!-- <button class="btn btn-primary submit-btn">Create Doctor</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var currentStep = 1;
        $(".nextBtn").click(function () {
            var $currentStep = $("#step" + currentStep);
            $currentStep.hide();
            $("#step" + (currentStep + 1)).show();
            currentStep++;
        });

        $(".prevBtn").click(function () {
            var $currentStep = $("#step" + currentStep);
            $currentStep.hide();
            $("#step" + (currentStep - 1)).show();
            currentStep--;
        });

        // Nepali Date
        $('#dobBS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#dobBS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#dobAD').val(englishDate);
            }
        });
        $('#grad_yearBS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#grad_yearBS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#grad_yearAD').val(englishDate);
            }
        });
        $('#start_dateBS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#start_dateBS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#start_dateAD').val(englishDate);
            }
        });
        $('#end_dateBS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#end_dateBS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#end_dateAD').val(englishDate);
            }
        });
    });
</script>

@endsection