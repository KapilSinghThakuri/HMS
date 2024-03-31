@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">

                    <form method="POST" action="{{ route('doctor.store')}}" id="wizardForm" enctype="multipart/form-data">
                        @csrf
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
                                        <input name="first_name" id="first_name" value="{{ old('first_name')}}" class="form-control" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Middle Name </label>
                                        <input name="middle_name" id="middle_name" value="{{ old('last_name')}}" class="form-control" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input name="last_name" id="last_name" value="{{ old('last_name')}}" class="form-control" type="text" autofocus>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Profile</label>
                                        <div class="profile-upload">
                                            <div class="upload-input">
                                                <input type="file" name="profile" value="{{ old('profile')}}" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input name="phone" value="{{ old('phone')}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Department<span class="text-danger">*</span></label>
                                        <select class="form-control select" name="department_id">
                                            <option disabled selected> Chose departments </option>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->id  }}">{{ $department->department_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>License Number <span class="text-danger">*</span></label>
                                        <input name="license_no" value="{{ old('license_no')}}" type="text" class="form-control ">
                                    </div>
                                </div>
    							<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="dobBS" name="dobBS" value="{{ old('dobBS')}}" placeholder="Select your DOB" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="date" readonly id="dobAD" name="dobAD" value="{{ old('dobAD')}}" class="form-control datetimepicker">
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
                                        <select id="country" class="form-control select" name="country">
                                            <option disabled selected> Select your country </option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country ->english_name }}" {{ $country->english_name == 'Nepal' ? 'selected' : '' }}>{{ $country ->english_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Province<span class="text-danger">*</span></label>
                                        <select id="province" class="form-control select" name="province">
                                            <option disabled selected> Select your Province </option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province_name_nep }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select id="district" class="form-control select" name="district">
                                            <option selected disabled> Select your district </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Municipality<span class="text-danger">*</span></label>
                                        <select id="municipality" class="form-control select" name="municipality">
                                            <option disabled selected> Select your Municipality </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input name="street" type="text" value="{{ old('street')}}" class="form-control ">
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
                                        <input name="institute_name" value="{{ old('institute_name')}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Medical Degree <span class="text-danger">*</span></label>
                                        <input name="medical_degree" value="{{ old('medical_degree')}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="grad_yearBS" value="{{ old('grad_yearBS')}}" name="grad_yearBS" placeholder="Select Your Graduation Year" name="grad_year" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input readonly type="date" id="grad_yearAD" name="grad_yearAD" value="{{ old('grad_yearAD')}}" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input name="specialization" value="{{ old('specialization')}}" type="text" class="form-control ">
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
                                        <input name="org_name" value="{{ old('org_name')}}" type="text" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[BS] <span class="text-danger">*</span></label>
                                        <input name="start_dateBS" type="dob" value="{{ old('start_dateBS')}}" id="start_dateBS" placeholder="Select your start date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" name="start_dateAD" id="start_dateAD" value="{{ old('start_dateAD')}}" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[BS] <span class="text-danger">*</span></label>
                                        <input name="end_dateBS" type="dob" id="end_dateBS" value="{{ old('end_dateBS')}}" placeholder="Select your end date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" id="end_dateAD" name="end_dateAD" value="{{ old('end_dateAD')}}" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea name="jobDescription" class="form-control" rows="3" cols="30">{{ old('jobDescription')}}</textarea>
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
                                        <input name="email" class="form-control" value="{{ old('email')}}" type="email">
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
                                <button type="submit" class="btn btn-primary">Create Doctor</button>
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

    // Add Doctor Form Wizards
        var currentStep = 1;

        // function checkFields() {
        //     var $currentStep = $("#step" + currentStep);
        //     var currentPageInput = $currentStep.find('input');
        //     var isAnyFieldFilled = false;

        //     currentPageInput.each(function() {
        //         var inputValue = $(this).val();
        //         console.log(inputValue);
        //         if (inputValue.trim() != '') {
        //             isAnyFieldFilled = true;
        //             return false;
        //         }
        //     });

        //     if (isAnyFieldFilled) {
        //         $('.nextBtn').prop("disabled", false);
        //     }
        //     else {
        //         $('.nextBtn').prop("disabled", true);
        //     }
        // }

        // checkFields();

        // $(".nextBtn").click(function () {
        //     checkFields();
        //     var $currentStep = $("#step" + currentStep);

        //     $currentStep.hide();
        //     $("#step" + (currentStep + 1)).show();
        //     currentStep++;
        // });

        // $('.nextBtn').click(function() {
        //     var $currentStep = $("#step" + currentStep);
        //     var currentPageInput = $currentStep.find('input, select');

        //     // Validation logic goes here if needed

        //     // Proceed to the next step
        //     $currentStep.hide();
        //     $("#step" + (currentStep + 1)).show();
        //     currentStep++;

        //     checkFields(); // Check fields on next step
        // });

        // var $currentStep = $("#step" + currentStep);
        // var currentPageInput = $currentStep.find('input');
        //     var isAnyFieldFilled = false;

        //     currentPageInput.each(function() {
        //         var inputValue = $(this).val();
        //         console.log(inputValue);
        //         if (inputValue.trim() !=== '') {
        //             isAnyFieldFilled = true;
        //             return false;
        //         }
        //     });

        //     if (isAnyFieldFilled) {
        //         $(".nextBtn").click(function () {

        //             $currentStep.hide();
        //             $("#step" + (currentStep + 1)).show();
        //             currentStep++;
        //         });

        //         $('.nextBtn').prop("disabled", false);
        //     }
        //     else {
        //         $('.nextBtn').prop("disabled", true);
        //         console.log('all fields are required!!!');
        //     }

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