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
}