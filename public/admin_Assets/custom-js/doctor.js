////////////////////////////            ADD DOCTOR JavaScript Code         //////////////////////////

////////////////////////////            For Profile Load         ////////////////////////////////
    var loadFile = function(event) {
        var image = document.getElementById('placeholder_image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
////////////////////////////        Temporary Input Fields For Addresses         ///////////////////////////
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

            clonedAddress.querySelectorAll('input').forEach(function(input) {
                input.value = '';
            });
            const inputErrorsDiv = clonedAddress.querySelector('#inputErrors2');
                if (inputErrorsDiv) {
                    inputErrorsDiv.parentNode.removeChild(inputErrorsDiv);
                }

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
            const inputErrorsDiv = clonedDegree.querySelector('#inputErrors3');
                if (inputErrorsDiv) {
                    inputErrorsDiv.parentNode.removeChild(inputErrorsDiv);
                }

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

            // Making empty the newly cloned input fields
            clonedExperience.querySelectorAll('input,textarea').forEach(function(input) {
                input.value = '';
            });
            const inputErrorsDiv = clonedExperience.querySelector('#inputErrors4');
                if (inputErrorsDiv) {
                    inputErrorsDiv.parentNode.removeChild(inputErrorsDiv);
                }

            addNextExperience.appendChild(tempDiv);
            addNextExperience.appendChild(clonedExperience);
            experienceCounter++;



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