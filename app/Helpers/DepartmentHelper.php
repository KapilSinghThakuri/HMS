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
}
