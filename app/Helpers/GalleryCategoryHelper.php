<?php

namespace App\Helpers;

use App\Models\AlbumCategory;

/**
 *
 */
class GalleryCategoryHelper
{

    public function __construct(AlbumCategory $categories)
    {
        $this->categories = $categories;
    }

    public function dropdown()
    {
        $albumCategories = $this->categories->orderBy('id', 'desc')
            ->pluck('album_title', 'id');
        return $albumCategories;
    }
    public function getPatientCarePhotos()
    {
        $patientCareCategory = $this->categories->where('album_title', 'Patient Care')->first();
        $patientCarePhotos = $patientCareCategory->photos;
        return $patientCarePhotos;
    }
    public function getStaffTeamsPhotos()
    {
        $StaffTeamsCategory = $this->categories->where('album_title', 'Staff & Teams')->first();
        $StaffTeamsPhotos = $StaffTeamsCategory->photos;
        return $StaffTeamsPhotos;
    }
    public function getHospitalHistoryPhotos()
    {
        $HospitalHistoryCategory = $this->categories->where('album_title', 'Hospital History')->first();
        $HospitalHistoryPhotos = $HospitalHistoryCategory->photos;
        return $HospitalHistoryPhotos;
    }
}