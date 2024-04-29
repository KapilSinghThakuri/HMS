<?php

namespace App\Helpers;

use App\Models\Page;

/**
 *
 */
class PageHelper
{
     public function __construct(Page $page)
    {
       return $this->page = $page;
    }
}
