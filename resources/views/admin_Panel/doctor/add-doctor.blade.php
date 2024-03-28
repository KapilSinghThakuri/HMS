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

                    <form id="wizardForm">
                        <div id="step1" class="step">
                            <div class="row">
                                <div class="col-lg-8 offset-lg-2">
                                    <h4 class="page-title text-center border-bottom">Basic Details</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input name="first_name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Middle Name </label>
                                        <input name="first_name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input name="last_name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input name="email" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Phone <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Profile</label>
                                        <div class="profile-upload">
                                            <div class="upload-img">
                                                <img alt="" src="assets/img/user.jpg">
                                            </div>
                                            <div class="upload-input">
                                                <input type="file" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
    							<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="nepaliDate" placeholder="Select your DOB" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="date" id="englishDate" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
    								<div class="form-group gender-select">
    									<label class="gen-label">Gender <span class="text-danger">*</span></label>
    									<div class="form-check-inline">
    										<label class="form-check-label">
    											<input type="radio" name="gender" class="form-check-input">Male
    										</label>
    									</div>
    									<div class="form-check-inline">
    										<label class="form-check-label">
    											<input type="radio" name="gender" class="form-check-input">Female
    										</label>
    									</div>
    								</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Country<span class="text-danger">*</span></label>
                                        <select class="form-control select">
                                            <option selected> Select your country </option>
                                            @foreach($countries as $country)
                                            <option>{{ $country ->english_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>District<span class="text-danger">*</span></label>
                                        <select class="form-control select">
                                            <option selected> Select your district </option>
                                            @foreach($districts as $district)
                                            <option>{{ $district ->district_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Province<span class="text-danger">*</span></label>
                                        <select class="form-control select">
                                            <option selected> Select your Province </option>
                                            @foreach($provinces as $province)
                                            <option>{{ $province -> province_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Municipality<span class="text-danger">*</span></label>
                                        <select class="form-control select">
                                            <option selected> Select your Municipality </option>
                                            <option>Nepal</option>
                                            <option>India</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Street</label>
                                                <input type="text" class="form-control ">
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
                                        <input name="institute_name" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Medical Degree <span class="text-danger">*</span></label>
                                        <input name="medical_degree" class="form-control" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[BS] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="dob" id="grad_yearBS" placeholder="Select Your Graduation Year" name="grad_year" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Graduation Year[AD] <span class="text-danger">*</span></label>
                                        <div class="cal-icon">
                                            <input type="date" id="grad_yearAD" name="grad_year" class="form-control datetimepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Specialization <span class="text-danger">*</span></label>
                                        <input name="specialization" type="text" class="form-control ">
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
                                        <input name="org_name" type="text" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[BS] <span class="text-danger">*</span></label>
                                        <input name="start_date" type="dob" id="start_dateBS" placeholder="Select your start date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Start Date[AD] <span class="text-danger">*</span></label>
                                        <input type="date" name="start_date" id="start_dateAD" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[BS] <span class="text-danger">*</span></label>
                                        <input name="end_date" type="dob" id="end_dateBS" placeholder="Select your end date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>End Date[AD] <span class="text-danger">*</span></label>
                                        <input type="date" id="end_dateBS" name="end_date" class="form-control ">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Job Description</label>
                                        <textarea class="form-control" rows="3" cols="30"></textarea>
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
                                        <input name="email" class="form-control" type="email">
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
                                        <input name="re-password" class="form-control" type="password">
                                    </div>
                                </div>
                            </div>

                            <div class="m-t-20 text-center">
                                <button type="button" class="btn btn-secondary prevBtn">Previous</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
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
            if ($currentStep.find("input:invalid").length > 0) {
                // If there are invalid fields, do not proceed to the next step
                return;
            }
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

        $("#wizardForm").submit(function (e) {
            e.preventDefault();
        });

        // Nepali Date
        $('#nepaliDate').nepaliDatePicker();
        $('#grad_year').nepaliDatePicker();
        $('#start_date').nepaliDatePicker();
        $('#end_date').nepaliDatePicker();

        $('#nepaliDate').change(function () {
        var nepaliDate = $(this).val();
        var englishDate = NepaliFunctions.BS2AD(nepaliDate);
        console.log(englishDate);
        $('#englishDate').val(englishDate);
    });

    });
</script>
@endsection