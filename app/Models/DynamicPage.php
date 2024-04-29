<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicPage extends Model
{
    use HasFactory;

    protected $table = "pages";
    protected $casts = [
        'title' => 'json',
        'content' => 'json',
    ];
    protected $fillable = [
        'slug',
        'image',
        'title',
        'content',
    ];
}
