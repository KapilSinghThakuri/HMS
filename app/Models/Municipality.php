<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    use HasFactory;

    protected $table = 'municipalities';
    protected $guarded = [];

    public function doctors(): HasOne
    {
        return $this->hasOne(Doctor::class,'municipality_id','id');
    }
    public function district()
    {
        return $this->belongsTo(District::class,'district_id','district_code');
    }
}
