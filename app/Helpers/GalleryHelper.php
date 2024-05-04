<?php

namespace App\Helpers;

use App\Models\Gallery;
use App\Models\AlbumCategory;

/**
 *
 */
class GalleryHelper
{

    public function __construct(Gallery $photo)
    {
        $this->photo = $photo;
    }
}