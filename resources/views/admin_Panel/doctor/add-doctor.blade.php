@extends('admin_Panel.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('doctor.store')}}" id="wizardForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Details -->
                        <div id="step1" class="step">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title">Basic Details</h4>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a class="btn btn-danger btn-rounded" href="{{ route('doctor.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
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
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors1" class="form-group"></div>
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
                                                    <input type="dob" name="date_of_birth_BS" id="date_of_birth_BS" value="{{ old('date_of_birth_BS')}}" placeholder="Select your DOB" class="form-control datetimepicker">
                                                    @error('date_of_birth_BS')<span class="text-danger">{{ $message }}</span>@enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Date of Birth[AD] <span class="text-danger">*</span></label>
                                                <div class="cal-icon">
                                                    <input type="date" readonly id="date_of_birth_AD" name="date_of_birth_AD" value="{{ old('date_of_birth_AD')}}" class="form-control datetimepicker">
                                                    @error('date_of_birth_AD')<span class="text-danger">{{ $message }}</span>@enderror
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

                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-primary btn-lg nextBtn1" style="width: 125px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                        <!-- Address Details -->
                        <div id="step2" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Address Details</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <h4 class="page-title">Permanent Address </h4>
                                </div>
                            </div>
                            <div class="row" id="doctor_permanent_address">
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors2" class="form-group"></div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select id="country" class="form-control select" name="country_id">
                                            <option disabled selected> Select your country </option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country ->id }}" {{ $country->english_name == 'Nepal' ? 'selected' : '' }}>{{ $country ->english_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Province<span class="text-danger">*</span></label>
                                        <select id="province" class="form-control select" name="province_id">
                                            <option disabled selected> Select your Province </option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}">{{ $province->province_name_nep }}</option>
                                            @endforeach
                                        </select>
                                        @error('province_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select id="district" class="form-control select" name="district_id">
                                            <option selected disabled> Select your district </option>
                                        </select>
                                        @error('district_id')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Municipality<span class="text-danger">*</span></label>
                                        <select id="municipality" class="form-control select" name="municipality_id">
                                            <option disabled selected> Select your Municipality </option>
                                        </select>
                                        @error('municipality_id')<span class="text-danger">{{ $message }}</span>@enderror
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
                            <div class="m-t-20 text-center" id="addTempAddressBtn">
                                <button  type="button" onclick="tempAddress()" class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Add Temporary Address</button>
                            </div>
                            <div id="doctor_temporary_address">
                                <!-- here newly added temporary address ia placed... -->
                            </div>
                            <div class="m-t-20 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-secondary mr-auto btn-lg prevBtn" style="width: 130px; letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
                                <button type="button" class="btn btn-primary ml-auto btn-lg nextBtn2" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                        <!-- Education Details -->
                        <div id="step3" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Educational Details</h4>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-lg-12">
                                    <h4 class="page-title">Medical Address </h4>
                                </div>
                            </div>
                            <div class="row" id="medical_degree">
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors3" class="form-group"></div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Institute Name <span class="text-danger">*</span></label>
                                        <input id="institute_name" name="institute_name[]" value="" class="form-control" type="text">
                                        @error('institute_name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Medical Degree <span class="text-danger">*</span></label>
                                        <input id="doctor_medical_degree" name="medical_degree[]" value="" class="form-control" type="text">
                                        @error('medical_degree')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="graduation_year_BS" value="" name="graduation_year_BS[]" placeholder="Select Your Graduation Year" class="form-control datetimepicker">
                                            @error('graduation_year_BS')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input readonly type="date" id="graduation_year_AD" name="graduation_year_AD[]" value="" class="form-control datetimepicker">
                                            @error('graduation_year_AD')<span class="text-danger">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input id="specialization" name="specialization[]" value="" type="text" class="form-control ">
                                        @error('specialization')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>

                            <div id="addNextDegree">
                                <!-- Here new degree input fields are placed... -->
                            </div>
                            <div class="m-t-20 text-center" id="addNewDegreeBtn">
                                <button  type="button" onclick="nextDegree()" class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Add Next Degree</button>
                            </div>

                            <div class="m-t-20 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-primary mr-auto btn-lg prevBtn" style="width: 130px; letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
                                <button type="button" class="btn btn-primary ml-auto btn-lg nextBtn3" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                        <!-- Experience Details -->
                        <div id="step4" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Experience Details</h4>
                                </div>
                            </div>
                            <div class="row" id="experience">
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors4" class="form-group"></div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Organization Name <span class="text-danger">*</span></label>
                                        <input id="org_name" name="org_name[]" value="" type="text" class="form-control ">
                                        @error('org_name')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[BS] <span class="text-danger">*</span></label>
                                        <input name="start_date_BS[]" type="dob" value="" id="start_date_BS" placeholder="Select your start date" class="form-control ">
                                        @error('start_date_BS')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" name="start_date_AD[]" id="start_date_AD" value="" class="form-control ">
                                        @error('start_date_AD')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[BS] <span class="text-danger">*</span></label>
                                        <input name="end_date_BS[]" type="dob" id="end_date_BS" value="" placeholder="Select your end date" class="form-control ">
                                        @error('end_date_BS')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" id="end_date_AD" name="end_date_AD[]" value="" class="form-control ">
                                        @error('end_date_AD')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea id="job_description" name="job_description[]" class="form-control" rows="3" cols="30"></textarea>
                                        @error('job_description')<span class="text-danger">{{ $message }}</span>@enderror
                                    </div>
                                </div>
                            </div>
                            <div id="addNextExperience">
                                <!-- Here new experience input fields are apppear -->
                            </div>
                            <div class="m-t-20 text-center" id="addNewExperienceBtn">
                                <button  type="button" onclick="nextExperience()" class="btn btn-success"> <i class="fa fa-plus" aria-hidden="true"></i> Add Next Experience</button>
                            </div>
                            <div class="m-t-20 d-flex justify-content-between">
                                <button type="button" class="btn btn-lg mr-auto btn-outline-primary prevBtn" style="width: 130px; letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
                                <button type="button" class="btn btn-lg ml-auto btn-primary nextBtn4" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                        <!-- User Credentials Details -->
                        <div id="step5" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Account Credentials</h4>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Form field validations -->
                                <div class="col-sm-12">
                                    <div id="inputErrors5" class="form-group"></div>
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

                            <!-- <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="submit" class="createDoctor btn btn-primary">Create Doctor</button>
                            </div> -->
                            <div class="m-t-20 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-primary mr-auto btn-lg prevBtn" style="width: 130px; height: 45px;  letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
                                <button type="submit" class="createDoctor btn btn-primary ml-auto btn-lg" style="width: 180px;  height: 45px; letter-spacing: 2px; font-size: 1.15rem;">Create Doctor</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
////////////////////////////            For Profile Load         ////////////////////////////////
    var loadFile = function(event) {
        var image = document.getElementById('placeholder_image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
////////////////////////////        Temporary Input Fields For Addresses         ////////////////////////////////
    let isCloned = false;
    let tempProvinceId = '';
    let tempDistrictId = '';
    let tempMunicipalityId = '';
    function tempAddress() {
        if (!isCloned) {
            var addTempAddressBtn = document.getElementById('addTempAddressBtn');
            addTempAddressBtn.style.display = 'none';

            const mainDiv = document.getElementById('step2');
            const nodeAddress = document.getElementById('doctor_permanent_address');
            const clonedAddress = nodeAddress.cloneNode(true);

            const tempDiv = document.createElement('div');
            tempDiv.classList.add('mt-3');

            var temTitle = document.createElement('h4');
            temTitle.textContent = 'Temporary Address';
            temTitle.classList.add('page-title','float-left');
            tempDiv.appendChild(temTitle);

            var removeBtn = document.createElement('span');
            removeBtn.innerHTML = '<i class="fa fa-times"></i> Remove Temporary Address';
            removeBtn.classList.add('btn', 'btn-danger', 'float-right');
            tempDiv.appendChild(removeBtn);

            doctor_temporary_address.appendChild(tempDiv);
            doctor_temporary_address.appendChild(clonedAddress);
            isCloned = true;

            // Making new unique Name for newly cloned div input fields
            clonedAddress.querySelectorAll('input, select').forEach(function(input) {
                var originalName = input.getAttribute('name');
                var newName = 'temp_'+originalName;
                input.setAttribute('name', newName);
                console.log(newName);

                // for extracting the new name of province and district
                // Check if the input field is for province
                if (originalName.includes('province')) {
                    tempProvinceName = newName;
                }
                if (originalName.includes('district')) {
                    tempDistrictName = newName;
                }
                if (originalName.includes('municipality')) {
                    tempMunicipalityName = newName;
                }
            });

            // Making new unique Id's for newly cloned div input fields
            clonedAddress.querySelectorAll('input, select').forEach(function(input) {
                var originalId = input.getAttribute('id');
                var newId = originalId + '_tempId'; // Appending '_tempId' to the original ID
                input.setAttribute('id', newId);
                console.log(newId);

                // for extracting the new ID of province, district, and municipality
                // Check if the input field is for province
                if (originalId.includes('province')) {
                    tempProvinceId = newId;
                }
                if (originalId.includes('district')) {
                    tempDistrictId = newId;
                }
                if (originalId.includes('municipality')) {
                    tempMunicipalityId = newId;
                }
            });
            // console.log(tempProvinceId);

            // Get districts based on province for newly cloned div
            $("#" + tempProvinceId).on('change', function () {
                var provinceId = $(this).val();
                console.log(provinceId);
                if (provinceId) {
                    $.ajax({
                        url: '/Healwave/doctor/profile/edit/district/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function (response) {
                            // console.log(response);
                            var districtSelect = $('#' + tempDistrictId);
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
                    $('#' + tempDistrictId).empty().append('<option value="">Select Your District</option>');
                }
            });
            // Get municipalitis based on district for newly cloned div
            $("#" + tempDistrictId).on('change', function () {
                var districtId = $(this).val();
                console.log(districtId);
                if(districtId){
                    $.ajax({
                        url: '/Healwave/doctor/profile/edit/municipality/' + districtId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response){
                            // console.log(response);
                            var municipalitySelect = $('#' + tempMunicipalityId);
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
                    $('#'+tempMunicipalityId).empty().append('<option value="">Select Your Municipality</option>');
                }
            });

            removeBtn.onclick = function() {
                addTempAddressBtn.style.display = 'block';

                const mainDiv = document.getElementById('step2');
                doctor_temporary_address.removeChild(tempDiv);
                doctor_temporary_address.removeChild(clonedAddress);

                isCloned = false;
            };

        } else {
            console.log('Parent node has already been cloned.');
        }
    }
////////////////////////////        New Input field for Education Details         ////////////////////////////////
    let degreeCounter = 0;
    const degreeTitles = ["+2 Degree", "Bachelor's Degree","Master's Degree(Optional)"];
    function nextDegree() {
        if (degreeCounter<3) {

            const mainDiv = document.getElementById('step3');
            const nodeDegree = document.getElementById('medical_degree');
            const clonedDegree = nodeDegree.cloneNode(true);

            clonedDegree.removeAttribute('id');
            const tempDiv = document.createElement('div');
            tempDiv.classList.add('mt-3');

            // Setting unique name for cloned div's id and input field name here...
            var inputFieldIdBS = clonedDegree.querySelector('#graduation_year_BS');
            var newGradIdBS = inputFieldIdBS.id+ [degreeCounter];
            inputFieldIdBS.id = newGradIdBS;
            console.log(newGradIdBS);

            var inputFieldIdAD = clonedDegree.querySelector('#graduation_year_AD');
            var newGradIdAD = inputFieldIdAD.id+ [degreeCounter];
            inputFieldIdAD.id = newGradIdAD;
            console.log(newGradIdAD);

            var temTitle = document.createElement('h4');
            temTitle.textContent = degreeTitles[degreeCounter];
            temTitle.classList.add('page-title','float-left');
            tempDiv.appendChild(temTitle);

            var removeBtn = document.createElement('span');
            removeBtn.innerHTML = '<i class="fa fa-times"></i> Remove this degree';
            removeBtn.classList.add('btn', 'btn-danger', 'float-right');
            tempDiv.appendChild(removeBtn);

            addNextDegree.appendChild(tempDiv);
            addNextDegree.appendChild(clonedDegree);
            degreeCounter++;

            // Making empty the newly cloned input fields
            clonedDegree.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });

            if (degreeCounter === 3) {
                var addNewDegreeBtn = document.getElementById('addNewDegreeBtn');
                addNewDegreeBtn.style.display = 'none';
            } else {
                addTempAddressBtn.style.display = 'block';
            }

            $('#' + newGradIdBS).nepaliDatePicker({
                onChange: function() {
                    var nepaliDate = $('#' + newGradIdBS).val();
                    console.log(nepaliDate);
                    var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                    $('#' + newGradIdAD).val(englishDate);
                }
            });

            removeBtn.onclick = function() {
                degreeCounter--;

                if (degreeCounter < 3) {
                    var addNewDegreeBtn = document.getElementById('addNewDegreeBtn');
                    addNewDegreeBtn.style.display = 'block';
                }

                const mainDiv = document.getElementById('step3');
                addNextDegree.removeChild(tempDiv);
                addNextDegree.removeChild(clonedDegree);
            };
        }else{
            console.log('You can add only 3 different degree!!!');
        }
    }
////////////////////////////        New Input field for Experience Details         ////////////////////////////////
    let experienceCounter = 0;
    const experienceTitles = ["A Experience", "B Experience","C Experience(Optional)"];
    function nextExperience() {
        if (experienceCounter<3) {

            const mainDiv = document.getElementById('step4');
            const nodeExperience = document.getElementById('experience');
            const clonedExperience = nodeExperience.cloneNode(true);

            clonedExperience.removeAttribute('id');
            const tempDiv = document.createElement('div');
            tempDiv.classList.add('mt-3');

            // Setting unique name for cloned div's id and input field name here...
            var startDateBsId = clonedExperience.querySelector('#start_date_BS');
            var newStartDateBsId = startDateBsId.id + [experienceCounter];
            startDateBsId.id = newStartDateBsId;
            console.log(newStartDateBsId);

            var startDateAdId = clonedExperience.querySelector('#start_date_AD');
            var newStartDateAdId = startDateAdId.id+ [experienceCounter];
            startDateAdId.id = newStartDateAdId;
            console.log(newStartDateAdId);

            var endDateBsId = clonedExperience.querySelector('#end_date_BS');
            var newEndDateBsId = endDateBsId.id + [experienceCounter];
            endDateBsId.id = newEndDateBsId;
            console.log(newEndDateBsId);

            var endDateAdId = clonedExperience.querySelector('#end_date_AD');
            var newEndDateAdId = endDateAdId.id + [experienceCounter];
            endDateAdId.id = newEndDateAdId;
            console.log(newEndDateAdId);

            // Creating title for new experience div
            var temTitle = document.createElement('h4');
            temTitle.textContent = experienceTitles[experienceCounter];
            temTitle.classList.add('page-title','float-left');
            tempDiv.appendChild(temTitle);
            // Creating remove button for new experience div
            var removeBtn = document.createElement('span');
            removeBtn.innerHTML = '<i class="fa fa-times"></i> Remove This Experience';
            removeBtn.classList.add('btn', 'btn-danger', 'float-right');
            tempDiv.appendChild(removeBtn);

            addNextExperience.appendChild(tempDiv);
            addNextExperience.appendChild(clonedExperience);
            experienceCounter++;

            // Making empty the newly cloned input fields
            clonedExperience.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });

            if (experienceCounter === 3) {
                var addNewExperienceBtn = document.getElementById('addNewExperienceBtn');
                addNewExperienceBtn.style.display = 'none';
            }

            // Converting the selected nepali dato to english date
            $('#' + newStartDateBsId).nepaliDatePicker({
                onChange: function() {
                    var nepaliDate = $('#' + newStartDateBsId).val();
                    console.log(nepaliDate);
                    var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                    $('#' + newStartDateAdId).val(englishDate);
                }
            });
            $('#' + newEndDateBsId).nepaliDatePicker({
                onChange: function() {
                    var nepaliDate = $('#' + newEndDateBsId).val();
                    console.log(nepaliDate);
                    var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                    $('#' + newEndDateAdId).val(englishDate);
                }
            });

            removeBtn.onclick = function() {
                experienceCounter--;
                if (experienceCounter < 3) {
                    var addNewExperienceBtn = document.getElementById('addNewExperienceBtn');
                    addNewExperienceBtn.style.display = 'block';
                }

                const mainDiv = document.getElementById('step4');
                addNextExperience.removeChild(tempDiv);
                addNextExperience.removeChild(clonedExperience);
            };
        }else{
            console.log('You can add only 3 different experiences !!!');
        }
    }

    $(document).ready(function () {
////////////////////////////        FOR BASIC DETAILS         ////////////////////////////////
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
            // if ($('#profile').val().trim() === '') {
            //     emptyFieldErrors.push('Profile is required');
            // }
            if ($('#date_of_birth_BS').val().trim() === '') {
                emptyFieldErrors.push('Date of Birth[BS] is required');
            }
            if ($('#date_of_birth_AD').val().trim() === '') {
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
            console.log(emptyFieldErrors);

            if (emptyFieldErrors.length > 0) {
                emptyFieldErrors.forEach(function (error) {
                    var errorMessage = emptyFieldErrors.join(' <br> - ');
                    $('#inputErrors1').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    // $('.nextBtn1').prop('disabled', true);
                    return false;
                });
            }
            else {
                $('#inputErrors1').empty();
                // $('.nextBtn1').prop('disabled', false);
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
////////////////////////////        FOR ADDRESS DETAILS         ////////////////////////////////
        function checkEmptyFieldStep2() {
            var emptyFieldErrors = [];

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
            //  Validations for temporary Address
            if (isCloned==true) {
                if ($('#country_tempId').val().trim() === '') {
                    emptyFieldErrors.push('Temporary Country is required');
                }

                var provinceValue = $('#province_tempId').val();
                if (provinceValue == null) {
                    emptyFieldErrors.push('Temporary Province is required');
                }

                var districtValue = $('#district_tempId').val();
                if (districtValue == null || districtValue === 'Select your district') {
                    emptyFieldErrors.push('Temporary District is required');
                }

                var municipalityValue = $('#municipality_tempId').val();
                if (municipalityValue == null || municipalityValue === 'Select your municipality') {
                    emptyFieldErrors.push('Temporary Municipality is required');
                }

                if ($('#street_tempId').val().trim() === '') {
                    emptyFieldErrors.push('Temporary Street is required');
                }
            }
            console.log(emptyFieldErrors);

            if (emptyFieldErrors.length > 0) {
                emptyFieldErrors.forEach(function (error) {
                    var errorMessage = emptyFieldErrors.join(' <br> - ');
                    $('#inputErrors2').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    // $('.nextBtn2').prop('disabled', true);
                    return false;
                });
            }
            else {
                $('#inputErrors2').empty();
                // $('.nextBtn2').prop('disabled', false);
                return true;
            }
        };
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
////////////////////////////        FOR EDCUATIONAL DETAILS         ////////////////////////////////
        function checkEmptyFieldStep3() {
            var emptyFieldErrors = [];

            if ($('#institute_name').val().trim() === '') {
                emptyFieldErrors.push('Institute Name is required');
            }
            if ($('#doctor_medical_degree').val().trim() === '') {
                emptyFieldErrors.push('Medical Degree is required');
            }
            if ($('#graduation_year_BS').val().trim() === '') {
                emptyFieldErrors.push('Graduation Year[BS] is required');
            }
            if ($('#graduation_year_AD').val().trim() === '') {
                emptyFieldErrors.push('Graduation Year[AD] is required');
            }
            if ($('#specialization').val().trim() === '') {
                emptyFieldErrors.push('Specialization is required');
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
////////////////////////////        FOR EXPERIENCE DETAILS         ////////////////////////////////
        function checkEmptyFieldStep4() {
            var emptyFieldErrors = [];

            if ($('#org_name').val().trim() === '') {
                emptyFieldErrors.push('Organization Name is required');
            }
            if ($('#start_date_BS').val().trim() === '') {
                emptyFieldErrors.push('Start Date[BS] is required');
            }
            if ($('#start_date_AD').val().trim() === '') {
                emptyFieldErrors.push('Start Date[AD] is required');
            }
            if ($('#end_date_BS').val().trim() === '') {
                emptyFieldErrors.push('End Date[BS] is required');
            }
            if ($('#end_date_AD').val().trim() === '') {
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
                    $('#inputErrors4').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    return false;
                });
            }
            else {
                $('#inputErrors4').empty();
                return true;
            }
        };
        $(".nextBtn4").click(function () {
            if (!checkEmptyFieldStep4()) {
                event.preventDefault();
                console.log('Failed Error!');
            }else{
                var $currentStep = $("#step" + currentStep);
                $currentStep.hide();
                $("#step" + (currentStep + 1)).show();
                currentStep++;
            }
        });
////////////////////////////        FOR CREDENTIALS DETAILS         ////////////////////////////////
        function checkEmptyFieldStep5(){
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
                    $('#inputErrors5').html('<div class="alert alert-danger">' + '- ' + errorMessage + '</div>');
                    return false;
                });
            }
            else {
                $('#inputErrors5').empty();
                return true;
            }
        };
        $(".createDoctor").click(function () {
            if (!checkEmptyFieldStep5()) {
                event.preventDefault();
                console.log('Failed Error!');
            }
        });


////////////////////////////        REMAINING         ////////////////////////////////
        $(".prevBtn").click(function () {
            var $currentStep = $("#step" + currentStep);
            $currentStep.hide();
            $("#step" + (currentStep - 1)).show();
            currentStep--;
        });

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

        // Nepali Date Of Birth
        $('#date_of_birth_BS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#date_of_birth_BS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#date_of_birth_AD').val(englishDate);
            }
        });
        $('#graduation_year_BS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#graduation_year_BS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#graduation_year_AD').val(englishDate);
            }
        });
        $('#start_date_BS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#start_date_BS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#start_date_AD').val(englishDate);
            }
        });
        $('#end_date_BS').nepaliDatePicker({
            onChange: function() {
                var nepaliDate = $('#end_date_BS').val();
                console.log(nepaliDate);
                var englishDate = NepaliFunctions.BS2AD(nepaliDate);
                $('#end_date_AD').val(englishDate);
            }
        });
    });
</script>
@endsection
