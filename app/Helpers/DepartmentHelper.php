<?php

namespace App\Helpers;

use App\Models\Department;

/**
 *
 */
class DepartmentHelper
{
    public function __construct(Department $department)
    {
        $this->department = $department;
    }
    public function dropdown()
    {
        $departmentName = $this->department->orderBy('id', 'desc')->pluck('department_name','id');
        return $departmentName;
    }
    public function getAllDepartment()
    {
        $departments = $this->department->get();
        return $departments;
    }
    public function getDepartmentIcon($departmentName)
    {
        switch ($departmentName) {
            case 'Cardiology':
                return 'fas fa-heartbeat';
            case 'Radiology':
                return 'fas fa-radiation';
            case 'Neurology':
                return 'fas fa-brain';
            case 'OT':
                return 'fas fa-syringe';
            case 'Plastic Surgery':
                return 'fas fa-cut';
            case 'Eye Care':
                return 'fas fa-eye';
            default:
                return 'fas fa-hospital-user';
        }
    }
}
