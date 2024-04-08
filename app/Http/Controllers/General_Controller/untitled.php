    public function update(ProfileRequest $request){
        $validatedData = $request->validated();
        $degreeRules = ProfileRequest::degreeRules();
        $validatedDegreeData = $request->validate($degreeRules);

        $experienceRules = ProfileRequest::experienceRules();
        $validatedExperienceData = $request->validate($experienceRules);

        $users = Auth::user();
        $id = $users->id;

        // Update user details
        $username = $validatedData['first_name'] .' '. $validatedData['middle_name'] .' '. $validatedData['last_name'];
        $user_address = $validatedData['province'] .'-'. $validatedData['district'] .'-'. $validatedData['street'];
        $users -> update([
            'username' => $username,
            'email' => $validatedData['email'],
            'address' => $user_address,
            'phone' => $validatedData['phone'],
        ]);

        // Update doctor details
        $doctors = $users->doctor;

        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $filePath = public_path('admin_Assets/img/doctors/' . $fileName);

            // Move the uploaded file to the desired location
            $file->move(public_path('admin_Assets/img/doctors'), $fileName);

            // Update the profile field in the database with the new file path
            $doctors->update([
                'profile' => '/admin_Assets/img/doctors/' . $fileName,
            ]);

            // Check if the old profile image exists and delete it
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }


        $doctors->update([
            'user_id' => $users->id,
            'department_id' =>$validatedData['department_id'],
            'first_name' => $validatedData['first_name'],
            'middle_name' => $validatedData['middle_name'],
            'last_name' => $validatedData['last_name'],
            'gender' => $validatedData['gender'],
            'date_of_birth_BS' => $validatedData['date_of_birth_BS'],
            'date_of_birth_AD' => $validatedData['date_of_birth_AD'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            // 'profile' => $validatedData['profile'] ?? $doctors->profile,
            'country_id' => $validatedData['country'] ,
            'province_id' => $validatedData['province'],
            'district_id' => $validatedData['district'],
            'municipality_id' => $validatedData['municipality'],
            'street' => $validatedData['street'],

            'temp_country_id' => $validatedData['country_tempName'] ?? '',
            'temp_province_id' => $validatedData['province_tempName'] ?? '',
            'temp_district_id' => $validatedData['district_tempName'] ?? '',
            'temp_municipality_id' => $validatedData['municipality_tempName'] ?? '',
            'temp_street' => $validatedData['street_tempName'] ?? '',
        ]);

        // Update education details
        $educations = $doctors->educations->first();
        $educations->update($validatedDegreeData);

        for ($i = 0; $i < count($validatedDegreeData); $i++) {
            $educations->updateOrCreate([
                'doctor_id' => $doctors->id,
                'institute_name' => $validatedDegreeData['institute_name'.$i],
                'medical_degree' => $validatedDegreeData['medical_degree'.$i],
                'graduation_year_BS' => $validatedDegreeData['graduation_year_BS'.$i],
                'graduation_year_AD' => $validatedDegreeData['graduation_year_AD'.$i],
                'specialization' => $validatedDegreeData['specialization'.$i],
            ]);
        }

        // Update experience details
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




    /////////////////////////////////////

for ($i = 0; $i < 3; $i++) {
    $educations->updateOrCreate(
        [
            'doctor_id' => $doctor->id,
        ],
        [
            'institute_name' => $validatedDegreeData["institute_name" . $i],
            'medical_degree' => $validatedDegreeData["medical_degree" . $i],
            'graduation_year_BS' => $validatedDegreeData["graduation_year_BS" . $i],
            'graduation_year_AD' => $validatedDegreeData["graduation_year_AD" . $i],
            'specialization' => $validatedDegreeData["specialization" . $i],
        ]
    );
}


