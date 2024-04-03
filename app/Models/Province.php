<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'provinces';
    protected $guarded = [];

    public function doctors(): HasOne
    {
        return $this->hasOne(Doctor::class,'province_id','id');
    }
    public function districts()
    {
        return $this->hasMany(District::class,'province_id','id');
    }
}
