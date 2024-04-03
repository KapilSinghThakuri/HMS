@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('doctor.store')}}" id="wizardForm" enctype="multipart/form-data">
                        @csrf
                        <div id="step1" class="step">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title">Basic Details</h4>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a class="btn btn-primary btn-rounded" href="{{ route('doctor.index')}}"><i class="fa fa-eye" aria-hidden="true"></i>View List</a>
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

                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>First Name <span class="text-danger">*</span></label>
                                                <input name="first_name" id="first_name" value="{{ old('first_name')}}" class="form-control" type="text" autofocus required>
                                                @error('first_name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Middle Name </label>
                                                <input name="middle_name" id="middle_name" value="{{ old('last_name')}}" class="form-control" type="text" autofocus>
                                                @error('middle_name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Last Name <span class="text-danger">*</span></label>
                                                <input name="last_name" id="last_name" value="{{ old('last_name')}}" class="form-control" type="text" autofocus>
                                                @error('last_name')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group gender-select">
                                                <label class="gen-label">Gender <span class="text-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input id="male" type="radio" name="gender" class="form-check-input" value="Male" {{ old('gender') == 'male' ? 'checked' : '' }}>Male
                                                        @error('male')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input id="female" type="radio" name="gender" class="form-check-input" value="Female" {{ old('gender') == 'female' ? 'checked' : '' }}>Female
                                                        @error('female')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date of Birth[BS] <span class="text-danger">*</span></label>
                                                <div class="cal-icon">
                                                    <input type="dob" id="dobBS" name="dobBS" value="{{ old('dobBS')}}" placeholder="Select your DOB" class="form-control datetimepicker">
                                                    @error('dobBS')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date of Birth[AD] <span class="text-danger">*</span></label>
                                                <div class="cal-icon">
                                                    <input type="date" readonly id="dobAD" name="dobAD" value="{{ old('dobAD')}}" class="form-control datetimepicker">
                                                    @error('dobAD')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="user_image_wrapper mb-2 text-center">
                                                <img id="placeholder_image" src="{{ asset('admin_Assets/img/user.jpg')}}" style="width: 200px; height: 200px;">
                                            </div>
                                            <div class="form-group">
                                                <!-- <label>Choose your profile</label> -->
                                                <div class="profile-upload">
                                                    <div class="upload-input">
                                                        <input type="file" id="profile" onchange="loadFile(event)" name="profile" value="{{ old('profile')}}" class="form-control">
                                                        @error('profile')<span class="text-danger">{{ $message }}</span>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input id="phone" name="phone" value="{{ old('phone')}}" class="form-control" type="text">
                                        @error('phone')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>License Number <span class="text-danger">*</span></label>
                                        <input id="license_no" name="license_no" value="{{ old('license_no')}}" type="text" class="form-control ">
                                        @error('license_no')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Department<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="department_id" id="department_id">
                                            <option disabled selected> Chose departments </option>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id  }}">{{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select id="country" class="form-control select" name="country">
                                            <option disabled selected> Select your country </option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country ->id }}" {{ $country->english_name == 'Nepal' ? 'selected' : '' }}>{{ $country ->english_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Province<span class="text-danger">*</span></label>
                                        <select id="province" class="form-control select" name="province">
                                            <option disabled selected> Select your Province </option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province_name_nep }}</option>
                                            @endforeach
                                        </select>
                                        @error('province')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select id="district" class="form-control select" name="district">
                                            <option selected disabled> Select your district </option>
                                        </select>
                                        @error('district')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Municipality<span class="text-danger">*</span></label>
                                        <select id="municipality" class="form-control select" name="municipality">
                                            <option disabled selected> Select your Municipality </option>
                                        </select>
                                        @error('municipality')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input name="street" id="street" type="text" value="{{ old('street')}}" class="form-control ">
                                                @error('street')<span class="text-danger">{{ $message }}</span>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-primary nextBtn1">Next</button>
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
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors2" class="form-group"></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Institute Name <span class="text-danger">*</span></label>
                                        <input id="institute_name" name="institute_name" value="{{ old('institute_name')}}" class="form-control" type="text">
                                        @error('institute_name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Medical Degree <span class="text-danger">*</span></label>
                                        <input id="medical_degree" name="medical_degree" value="{{ old('medical_degree')}}" class="form-control" type="text">
                                        @error('medical_degree')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="grad_yearBS" value="{{ old('grad_yearBS')}}" name="grad_yearBS" placeholder="Select Your Graduation Year" name="grad_year" class="form-control datetimepicker">
                                            @error('grad_yearBS')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input readonly type="date" id="grad_yearAD" name="grad_yearAD" value="{{ old('grad_yearAD')}}" class="form-control datetimepicker">
                                            @error('grad_yearAD')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input id="specialization" name="specialization" value="{{ old('specialization')}}" type="text" class="form-control ">
                                        @error('specialization')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="button" class="btn btn-primary nextBtn2">Next</button>
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
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors3" class="form-group"></div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Organization Name <span class="text-danger">*</span></label>
                                        <input id="org_name" name="org_name" value="{{ old('org_name')}}" type="text" class="form-control ">
                                        @error('org_name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[BS] <span class="text-danger">*</span></label>
                                        <input name="start_dateBS" type="dob" value="{{ old('start_dateBS')}}" id="start_dateBS" placeholder="Select your start date" class="form-control ">
                                        @error('start_dateBS')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" name="start_dateAD" id="start_dateAD" value="{{ old('start_dateAD')}}" class="form-control ">
                                        @error('start_dateAD')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[BS] <span class="text-danger">*</span></label>
                                        <input name="end_dateBS" type="dob" id="end_dateBS" value="{{ old('end_dateBS')}}" placeholder="Select your end date" class="form-control ">
                                        @error('end_dateBS')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" id="end_dateAD" name="end_dateAD" value="{{ old('end_dateAD')}}" class="form-control ">
                                        @error('end_dateAD')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea id="job_description" name="jobDescription" class="form-control" rows="3" cols="30">{{ old('jobDescription')}}</textarea>
                                        @error('jobDescription')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="button" class="btn btn-primary nextBtn3">Next</button>
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
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors4" class="form-group"></div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input id="email" name="email" class="form-control" value="{{ old('email')}}" type="email">
                                        @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input id="password" name="password" class="form-control" type="password">
                                        @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input id="password_confirmation" name="password_confirmation" class="form-control" type="password">
                                        @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="submit" class="createDoctor btn btn-primary">Create Doctor</button>
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
    var loadFile = function(event) {
        var image = document.getElementById('placeholder_image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };

    $(document).ready(function () {
        $('#province').change(function () {
            var provinceId = $(this).val();
            console.log(provinceId);
            if (provinceId) {
                $.ajax({
                    url: '/Healwave/admin/doctor/create/district/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        // console.log(response);
                        var districtSelect = $('#district');
                        districtSelect.empty().append('<option selected> Select your district </option>');

                        response.forEach(function(district) {
                            // console.log(district);
                            districtSelect.append('<option value="' + district.district_code + '">' + district['district_name[nep]'] + '</option>');
                        });
                    },
                    error: function(){
                        alert('Error Fetching District !!!');
                    }
                });
            }else {
                $('#district').empty().append('<option value="">Select Your District</option>');
            }
        });

        $('#district').change(function() {
            var districtId = $(this).val();
            console.log(districtId);
            if(districtId){
                $.ajax({
                    url: '/Healwave/admin/doctor/create/municipality/' + districtId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response){
                        // console.log(response);
                        var municipalitySelect = $('#municipality');
                        municipalitySelect.empty().append('<option selected> Select your municipality </option>');
                        response.forEach(function (municipality) {
                            // console.log(municipality);
                            municipalitySelect.append('<option value="' + municipality.municipality_code + '">' + municipality['municipality_name[nep]'] + '</option>');
                        });
                    },
                    error: function(){
                        alert('Error Fetching Municipality !!!');
                    }
                });
            }else {
                $('#municipality').empty().append('<option value="">Select Your Municipality</option>');
            }
        });


        function checkEmptyFieldStep1() {
            var emptyFieldErrors = [];

            if ($('#first_name').val().trim() === '') {
                emptyFieldErrors.push('First Name is required');
            }
            if ($('#last_name').val().trim() === '') {
                emptyFieldErrors.push('Last Name is required');
            }
            if (!$('#male').is(':checked') && !$('#female').is(':checked')) {
                emptyFieldErrors.push('Gender is required');
            }
            if ($('#profile').val().trim() === '') {
                emptyFieldErrors.push('Profile is required');
            }
            if ($('#dobBS').val().trim() === '') {
                emptyFieldErrors.push('Date of Birth[BS] is required');
            }
            if ($('#dobAD').val().trim() === '') {
                emptyFieldErrors.push('Date of Birth[AD] is required');
            }
            if ($('#phone').val().trim() === '') {
                emptyFieldErrors.push('Phone is required');
            }
            if ($('#license_no').val().trim() === '') {
                emptyFieldErrors.push('License Number is required');
            }
            var departmentIdValue = $('#department_id').val();
            // if (departmentIdValue !== null && departmentIdValue.toString().trim() === '') {
            if (departmentIdValue == null) {
                emptyFieldErrors.push('Department is required');
            }
            if ($('#country').val().trim() === '') {
                emptyFieldErrors.push('Country is required');
            }

            var provinceValue = $('#province').val();
            if (provinceValue == null) {
                emptyFieldErrors.push('Province is required');
            }

            var districtValue = $('#district').val();
            if (districtValue == null || districtValue === 'Select your district') {
                emptyFieldErrors.push('District is required');
            }

            var municipalityValue = $('#municipality').val();
            if (municipalityValue == null || municipalityValue === 'Select your municipality') {
                emptyFieldErrors.push('Municipality is required');
            }

            if ($('#street').val().trim() === '') {
                emptyFieldErrors.push('Street is required');
            }

            console.log(emptyFieldErrors);

            if (emptyFieldErrors.length > 0) {
                emptyFieldErrors.forEach(function (error) {
                    var errorMessage = emptyFieldErrors.join(' <br> - ');
                    $('#inputErrors').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    // $('.nextBtn1').prop('disabled', true);
                    return false;
                });
            }
            else {
                $('#inputErrors').empty();
                // $('.nextBtn1').prop('disabled', false);
                return true;
            }
        };

        function checkEmptyFieldStep2() {
            var emptyFieldErrors = [];

            if ($('#institute_name').val().trim() === '') {
                emptyFieldErrors.push('Institute Name is required');
            }
            if ($('#medical_degree').val().trim() === '') {
                emptyFieldErrors.push('Medical Degree is required');
            }
            if ($('#grad_yearBS').val().trim() === '') {
                emptyFieldErrors.push('Graduation Year[BS] is required');
            }
            if ($('#grad_yearAD').val().trim() === '') {
                emptyFieldErrors.push('Graduation Year[AD] is required');
            }
            if ($('#specialization').val().trim() === '') {
                emptyFieldErrors.push('Specialization is required');
            }

            console.log(emptyFieldErrors);

            if (emptyFieldErrors.length > 0) {
                emptyFieldErrors.forEach(function (error) {
                    var errorMessage = emptyFieldErrors.join(' <br> - ');
                    $('#inputErrors2').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    return false;
                });
            }
            else {
                $('#inputErrors2').empty();
                return true;
            }
        };

        function checkEmptyFieldStep3() {
            var emptyFieldErrors = [];

            if ($('#org_name').val().trim() === '') {
                emptyFieldErrors.push('Organization Name is required');
            }
            if ($('#start_dateBS').val().trim() === '') {
                emptyFieldErrors.push('Start Date[BS] is required');
            }
            if ($('#start_dateAD').val().trim() === '') {
                emptyFieldErrors.push('Start Date[AD] is required');
            }
            if ($('#end_dateBS').val().trim() === '') {
                emptyFieldErrors.push('End Date[BS] is required');
            }
            if ($('#end_dateAD').val().trim() === '') {
                emptyFieldErrors.push('End Date[AD] is required');
            }

            console.log($('#job_description').val());
            if ($('#job_description').val().trim() === '') {
                emptyFieldErrors.push('Job Description is required');
            }

            console.log(emptyFieldErrors);

            if (emptyFieldErrors.length > 0) {
                emptyFieldErrors.forEach(function (error) {
                    var errorMessage = emptyFieldErrors.join(' <br> - ');
                    $('#inputErrors3').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    return false;
                });
            }
            else {
                $('#inputErrors3').empty();
                return true;
            }
        };

        function checkEmptyFieldStep4(){
            var emptyFieldErrors = [];

            if ($('#email').val().trim() === '') {
                emptyFieldErrors.push('Email is required');
            }
            if ($('#password').val().trim() === '') {
                emptyFieldErrors.push('Password is required');
            }
            if ($('#password_confirmation').val().trim() === '') {
                emptyFieldErrors.push('Confirm Password is required');
            }

            console.log(emptyFieldErrors);

            if (emptyFieldErrors.length > 0) {
                emptyFieldErrors.forEach(function (error) {
                    var errorMessage = emptyFieldErrors.join(' <br> - ');
                    $('#inputErrors4').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    return false;
                });
            }
            else {
                $('#inputErrors4').empty();
                return true;
            }
        };

        var currentStep = 1;

        $(".nextBtn1").click(function (event) {
            if (!checkEmptyFieldStep1()) {
                event.preventDefault();
                console.log('Failed Error!');
            } else {
                var $currentStep = $("#step" + currentStep);
                $currentStep.hide();
                $("#step" + (currentStep + 1)).show();
                currentStep++;
            }
        });

        // var currentStep = 1;
        //     $(".nextBtn1").click(function () {
        //         if (!checkEmptyFieldStep1()) {
        //             var $currentStep = $("#step" + currentStep);
        //             $currentStep.hide();
        //             $("#step" + (currentStep + 1)).show();
        //             currentStep++;
        //         }else{
        //             event.preventDefault();
        //             console.log('Failed Error !');
        //             // return;
        //         }
        //     });

        $(".nextBtn2").click(function () {
            if (!checkEmptyFieldStep2()) {
                event.preventDefault();
                console.log('Failed Error!');
            }else{
                var $currentStep = $("#step" + currentStep);
                $currentStep.hide();
                $("#step" + (currentStep + 1)).show();
                currentStep++;
            }
        });

        $(".nextBtn3").click(function () {
            if (!checkEmptyFieldStep3()) {
                event.preventDefault();
                console.log('Failed Error!');
            }else{
                var $currentStep = $("#step" + currentStep);
                $currentStep.hide();
                $("#step" + (currentStep + 1)).show();
                currentStep++;
            }
        });

        $(".createDoctor").click(function () {
            if (!checkEmptyFieldStep4()) {
                event.preventDefault();
                console.log('Failed Error!');
            }
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