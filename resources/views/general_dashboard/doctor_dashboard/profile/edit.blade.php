@extends('general_dashboard.doctor_dashboard.layout.main')
@section('Main-container')

    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    {{ Breadcrumbs::render() }}
                    <form method="POST" action="{{ route('profile.update')}}" id="wizardForm" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Basic Details -->
                        <div id="step1" class="step">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title">My Profile</h4>
                                </div>
                                <div class="col-lg-6 text-right">
                                    <a class="btn btn-danger btn-lg btn-rounded" style="font-size: 1rem;" href="{{ route('doctor.profile')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>
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

                                <div class="col-lg-8">
                                    <div class="row">
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
                                            <div class="form-group gender-select">
                                                <label class="gen-label">Gender <span class="text-danger">*</span></label>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="gender" class="form-check-input" value="Male" {{ $doctor_basic->gender == 'Male' ? 'checked' : '' }} >Male
                                                    </label>
                                                </div>
                                                <div class="form-check-inline">
                                                    <label class="form-check-label">
                                                        <input type="radio" name="gender" class="form-check-input" value="Female" {{ $doctor_basic->gender == 'Female' ? 'checked' : '' }}>Female
                                                    </label>
                                                </div>
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
                                    </div>
                                </div>
                                <style>
                                    .user_image_wrapper {
                                        position: relative;
                                        border-radius: 50%;
                                        overflow: hidden;
                                        width: 200px;
                                        margin: 0 auto;
                                    }
                                    .user_image_wrapper img {
                                        width: 100% !important;
                                        object-fit: cover;
                                        height: 200px;
                                        }
                                    .user_image_wrapper input[type="file"]{
                                        height: 100%;
                                        width: 100%;
                                        position: absolute;
                                        top: 0;
                                        left: 0;
                                        opacity: 0;
                                    }
                                </style>
                                <div class="col-lg-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="user_image_wrapper mb-2 text-center">
                                                <img id="placeholder_image"
                                                    @if(isset($doctor_basic))
                                                        src="{{ asset($doctor_basic->profile) }}"
                                                    @else
                                                        src="{{ asset('admin_Assets/img/user.jpg')}}"
                                                    @endif
                                                    >
                                                    <input type="file" name="profile" value="" onchange="loadFile(event)" class="form-control">
                                            </div>
                                            <p class="text-center">Click To Upload Profile</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input name="phone" value="{{ $doctor_basic->phone }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>License Number <span class="text-danger">*</span></label>
                                        <input name="license_no" value="{{ $doctor_exp->license_no }}" type="text" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-4">
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

                            </div>
                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-primary btn-lg nextBtn" style="width: 125px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select id="country" class="form-control select" name="country">
                                            <option disabled selected> Select your country </option>
                                            @foreach($countries as $country)
                                            <option value="{{ $country ->id }}" {{ $country->english_name == 'Nepal' ? 'selected' : '' }}>{{ $country ->english_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Province<span class="text-danger">*</span></label>
                                        <select id="province" class="form-control select" name="province">
                                            <option disabled selected> Select your Province </option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province->id }}" {{ $province->id == $related_province->id ? 'selected' : '' }} >{{ $province -> province_name_nep }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select id="district" class="form-control select" name="district">
                                            <option disabled selected> Select your district </option>
                                            @foreach($doctor_districts as $district)
                                            <option value="{{ $district->district_code }}" {{ $district->district_code == $related_district->district_code ? 'selected' : ''  }}>{{ $district->{'district_name[nep]'} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Municipality<span class="text-danger">*</span></label>
                                        <select id="municipality" class="form-control select" name="municipality">
                                            <option disabled selected> Select your Municipality </option>
                                            @foreach($doctor_municipalities as $municipality)
                                            <option value="{{ $municipality->municipality_code }}" {{ $municipality->municipality_code == $related_municipality->municipality_code ? 'selected' : '' }} >{{ $municipality->{'municipality_name[nep]'} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input id="street" name="street" type="text" value="{{ $doctor_basic -> street}}" class="form-control ">
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
                                <button type="button" class="btn btn-outline-primary mr-auto btn-lg prevBtn" style="width: 130px; letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
                                <button type="button" class="btn btn-primary btn-lg ml-auto nextBtn" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                        <!-- Educational Details -->
                        <div id="step3" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Educational Details</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <h4 class="page-title">Medical Degree</h4>
                                </div>
                            </div>
                            <div class="row" id="medical_degree">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Institute Name <span class="text-danger">*</span></label>
                                        <input name="institute_name[]" value="{{ $doctor_edu -> institute_name}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Degree Title<span class="text-danger">*</span></label>
                                        <input name="medical_degree[]" value="{{ $doctor_edu -> medical_degree }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="grad_yearBS" value="{{ $doctor_edu -> graduation_year_BS}}" name="graduation_year_BS[]" placeholder="Select Your Graduation Year" name="grad_year" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input readonly type="date" id="grad_yearAD" name="graduation_year_AD[]" value="{{ $doctor_edu -> graduation_year_AD}}" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input name="specialization[]" value="{{ $doctor_edu -> specialization}}" type="text" class="form-control ">
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
                                <button type="button" class="btn btn-primary ml-auto btn-lg nextBtn" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                        <!-- Experiences Details -->
                        <div id="step4" class="step" style="display:none;">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Experience Details</h4>
                                </div>
                            </div>
                            <div class="row" id="experience">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Organization Name <span class="text-danger">*</span></label>
                                        <input name="org_name[]" value="{{ $doctor_exp->org_name }}" type="text" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[BS] <span class="text-danger">*</span></label>
                                        <input name="start_date_BS[]" type="dob" value="{{ $doctor_exp->start_date_BS }}" id="start_dateBS" placeholder="Select your start date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" name="start_date_AD[]" id="start_dateAD" value="{{ $doctor_exp->start_date_AD }}" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[BS] <span class="text-danger">*</span></label>
                                        <input name="end_date_BS[]" type="dob" id="end_dateBS" value="{{ $doctor_exp->end_date_BS }}" placeholder="Select your end date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[AD] <span class="text-danger">*</span></label>
                                        <input readonly type="date" id="end_dateAD" name="end_date_AD[]" value="{{ $doctor_exp->end_date_AD }}" class="form-control ">
                                    </div>
                                </div>
                                <style type="text/css">
                                      .ck.ck-editor__main div {
                                        height: 150px;
                                    }
                                </style>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea id="job_description" name="job_description[]" class="form-control" rows="3" cols="30">{{ $doctor_exp->job_description }}</textarea>
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
                                <button type="button" class="btn btn-lg ml-auto btn-primary nextBtn" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Next</button>
                            </div>
                        </div>

                    <!-- User & password details -->
                        <div id="step5" class="step" style="display:none;">
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
                            </div>

                            <div class="m-t-20 d-flex justify-content-between">
                                <button type="button" class="btn btn-outline-primary mr-auto btn-lg prevBtn" style="width: 130px; letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
                                <button type="submit" class="btn btn-primary ml-auto btn-lg" style="width: 120px; letter-spacing: 2px; font-size: 1.15rem;">Update</button>
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
// New Input Fields For Addresses
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
                var newName = originalName + '_tempName';
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


// New Input fields for Educations
    // intializing the degree counter for how we should add our education degree
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
            var inputFieldIdBS = clonedDegree.querySelector('#grad_yearBS');
            var newGradIdBS = inputFieldIdBS.id+ [degreeCounter];
            inputFieldIdBS.id = newGradIdBS;
            console.log(newGradIdBS);

            var inputFieldIdAD = clonedDegree.querySelector('#grad_yearAD');
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

    // New Input fields for Experience
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
            var startDateBsId = clonedExperience.querySelector('#start_dateBS');
            var newStartDateBsId = startDateBsId.id + [experienceCounter];
            startDateBsId.id = newStartDateBsId;
            console.log(newStartDateBsId);

            var startDateAdId = clonedExperience.querySelector('#start_dateAD');
            var newStartDateAdId = startDateAdId.id+ [experienceCounter];
            startDateAdId.id = newStartDateAdId;
            console.log(newStartDateAdId);

            var endDateBsId = clonedExperience.querySelector('#end_dateBS');
            var newEndDateBsId = endDateBsId.id + [experienceCounter];
            endDateBsId.id = newEndDateBsId;
            console.log(newEndDateBsId);

            var endDateAdId = clonedExperience.querySelector('#end_dateAD');
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


    var loadFile = function(event) {
        var image = document.getElementById('placeholder_image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
    ClassicEditor
        .create( document.querySelector( '#job_description' ) )
        .then( editor => {
                console.log( editor );
        } )
        .catch( error => {
                console.error( error );
        } );

    $(document).ready(function () {

        $('#province').change(function () {
            var provinceId = $(this).val();
            console.log(provinceId);
            if (provinceId) {
                $.ajax({
                    url: '/Healwave/doctor/profile/edit/district/' + provinceId,
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
                    url: '/Healwave/doctor/profile/edit/municipality/' + districtId,
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