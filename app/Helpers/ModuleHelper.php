<?php

namespace App\Helpers;

use App\Models\Module;

/**
 *
 */
class ModuleHelper
{

    public function __construct(Module $module)
    {
        $this->module = $module;
    }

    public function dropdown()
    {
        $modules = $this->module->pluck('model_name','id');
        return $modules;
    }
}