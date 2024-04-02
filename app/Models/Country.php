<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';
    protected $guarded = [];

    public function doctors(): HasOne
    {
        return $this->hasOne(Doctor::class, 'country_id','id');
    }
}
