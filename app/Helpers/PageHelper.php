<?php

namespace App\Helpers;

use App\Models\DynamicPage;

/**
 *
 */
class PageHelper
{

   public function __construct(DynamicPage $page)
   {
      return $this->page = $page;
   }
   public function dropdown()
   {
      $pages = $this->page->pluck('title','slug');
      return $pages;
   }
}
