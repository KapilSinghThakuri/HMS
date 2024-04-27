<?php

namespace App\Helpers;

use App\Models\Role;

/**
 *
 */
class RoleHelper
{
     public function __construct(Role $role)
    {
        $this->role = $role;
    }
    public function dropdown()
    {
        $roleName = $this->role->orderBy('id', 'desc')->pluck('name','id');
        return $roleName;
    }
}
