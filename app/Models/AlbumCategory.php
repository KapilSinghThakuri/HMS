<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumCategory extends Model
{
    use HasFactory;

    protected $table = 'gallery_categories';

    protected $fillable = [
        'display_order',
        'album_title',
        'album_cover',
        'status',
    ];

    public function photos()
    {
        return $this->hasMany(Gallery::class,'gallery_category_id');
    }
}
