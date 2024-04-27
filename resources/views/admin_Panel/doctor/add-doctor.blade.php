@extends('admin_Panel.layout.main')
@section('Main-container')
@inject('department_helper','App\Helpers\DepartmentHelper')

    <div class="page-wrapper">
        <div class="content">
            <div class="row align-items-center justify-content-between mb-4 breadcrumbs-div">
                <div class="col-sm-6">
                    {{ Breadcrumbs::render() }}
                </div>
                <div class="col-sm-6 text-right">
                   <a class="btn btn-danger btn-rounded" href="{{ route('doctor.index')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form method="POST" action="{{ route('doctor.store')}}" id="wizardForm" enctype="multipart/form-data">
                        @csrf
                        <!-- Basic Details -->
                        <div id="step1" class="step">
                            <div class="row">
                                <div class="col-lg-8 offset-md-2">
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
                                        {!! Form::select('department_id', $department_helper->dropdown(), null, ['class'=>'form-select form-control','placeholder' => 'Select Department','id' => 'department_id']) !!}
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
                                <button type="button" class="btn btn-outline-primary mr-auto btn-lg prevBtn" style="width: 130px; letter-spacing: 2px; font-size: 1.15rem;">Previous</button>
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
                                    <h4 class="page-title">Medical Degree </h4>
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
                                        <label>Academic Degree<span class="text-danger">*</span></label>
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

@endsection
