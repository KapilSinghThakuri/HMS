<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInfoSettings extends Model
{
    use HasFactory;
    protected $table = 'site_info_settings';
    protected $fillable = [
        'info_type',
        'label',
        'value',
        'icon',
        'display_order',
    ];
}
