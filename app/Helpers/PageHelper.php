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
   public function engPageTitledropdown()
   {
      $pages = $this->page->all();
      $pageList = $pages->mapWithKeys( function ($page) {
         $enPageName = isset($page['title']['en']) ? $page['title']['en'] : '';
         return [$page->id => $enPageName];
      });
      return $pageList;
   }
}
