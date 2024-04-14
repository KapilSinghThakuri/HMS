public function update(ProfileRequest $request){
    $validatedData = $request->validated();
    $degreeRules = ProfileRequest::degreeRules();
    $validatedDegreeData = $request->validate($degreeRules);

    $experienceRules = ProfileRequest::experienceRules();
    $validatedExperienceData = $request->validate($experienceRules);

    $users = Auth::user();
    $id = $users->id;


/////////////////////////////////////       // Update experience details
$experiences = $doctors->experiences->first();

    $experiences->update($validatedExperienceData);
    for ($i = 0; $i < count($validatedExperienceData); $i++) {
        $experiences->updateOrCreate([
            'doctor_id' => $doctors->id,
            'license_no' => $validatedExperienceData['license_no' . $i],
            'org_name' => $validatedExperienceData['org_name' . $i],
            'start_date_BS' => $validatedExperienceData['start_date_BS' . $i],
            'start_date_AD' => $validatedExperienceData['start_date_AD' . $i],
            'end_date_BS' => $validatedExperienceData['end_date_BS' . $i],
            'end_date_AD' => $validatedExperienceData['end_date_AD' . $i],
            'job_description' => $validatedExperienceData['job_description' . $i],
        ]);
    }
}

///////////////////     // Update education details

// if ($validatedDegreeData) {
//     for ($i = 0; $i < 3; $i++) {
//         $educations->updateOrCreate([
//             'doctor_id' => $doctor->id,
//             'institute_name' => $validatedDegreeData['institute_name'.$i],
//             'medical_degree' => $validatedDegreeData['medical_degree'.$i],
//             'graduation_year_BS' => $validatedDegreeData['graduation_year_BS'.$i],
//             'graduation_year_AD' => $validatedDegreeData['graduation_year_AD'.$i],
//             'specialization' => $validatedDegreeData['specialization'.$i],
//         ]);
//     }
// }
<!-- FORM REPEATER PART  -->
<!-- IN Blade file -->

// Setting unique name for cloned div's id and input field name here...
    // var oldInstitute_name = clonedDegree.querySelector('[name="institute_name"]');
    // var newInstitute_name = oldInstitute_name.name + [degreeCounter];
    // oldInstitute_name.name = newInstitute_name;
    // console.log(newInstitute_name);

    // var oldMedical_degree = clonedDegree.querySelector('[name="medical_degree"]');
    // var newMedical_degree = oldMedical_degree.name + [degreeCounter];
    // oldMedical_degree.name = newMedical_degree;
    // console.log(newMedical_degree);

    // var oldSpecialization = clonedDegree.querySelector('[name="specialization"]');
    // var newSpecialization = oldSpecialization.name + [degreeCounter];
    // oldSpecialization.name = newSpecialization;
    // console.log(newSpecialization);

    // var inputFieldNameBS = clonedDegree.querySelector('[name="graduation_year_BS"]');
    // var newGradNameBS = inputFieldNameBS.name + [degreeCounter];
    // inputFieldNameBS.name = newGradNameBS;
    // console.log(newGradNameBS);

    // var inputFieldNameAD = clonedDegree.querySelector('[name="graduation_year_AD"]');
    // var newGradNameAD = inputFieldNameAD.name + [degreeCounter];
    // inputFieldNameAD.name = newGradNameAD;
    // console.log(newGradNameAD);



// Setting unique name for cloned div's id and input field name here...
    // clonedExperience.querySelectorAll('input, select').forEach(function(input) {
    //     var originalName = input.getAttribute('name');
    //     var newName = originalName + [experienceCounter];
    //     input.setAttribute('name', newName);
    //     console.log(newName);
    // });

<!-- Request form validations -->
// Add validation rules for degree-related fields
    // public static function degreeRules()
    // {
    //     $rules = [];
    //     for ($i = 0; $i < 3; $i++) {
    //         $rules["institute_name$i"] = ['nullable', 'string', 'max:255'];
    //         $rules["medical_degree$i"] = ['nullable', 'string', 'max:255'];
    //         $rules["graduation_year_BS$i"] = ['nullable', 'date'];
    //         $rules["graduation_year_AD$i"] = ['nullable', 'date'];
    //         $rules["specialization$i"] = ['nullable', 'string', 'max:255'];
    //     }
    //     return $rules;
    // }

// Add validation rules for job-related fields
    // public static function experienceRules()
    // {
    //     $rules = [];
    //     for ($i = 0; $i < 3; $i++) {
    //         $rules["org_name$i"] = ['nullable', 'string', 'max:255'];
    //         $rules["start_date_BS$i"] = ['nullable', 'date'];
    //         $rules["start_date_AD$i"] = ['nullable', 'date'];
    //         $rules["end_date_BS$i"] = ['nullable', 'date'];
    //         $rules["end_date_AD$i"] = ['nullable', 'date'];
    //         $rules["job_description$i"] = ['nullable', 'string', 'max:255'];
    //     }
    //     return $rules;
    // }

<!-- IN Controller -->

// $degreeRules = ProfileRequest::degreeRules();
// $validatedDegreeData = $request->validate($degreeRules);
// dd($validatedDegreeData);

// $experienceRules = ProfileRequest::experienceRules();
// $validatedExperienceData = $request->validate($experienceRules);
// dd($validatedExperienceData);


// Update education details
// $educations = $doctor->educations->first();
// $validatedData['doctor_id'] = $doctor->id;
// if ($educations) {
//     $educations->update($validatedData);
// }

// Update experience details
// $experiences = $doctor->experiences->first();
// $validatedData['doctor_id'] = $doctor->id;
// $experiences->update($validatedData);

