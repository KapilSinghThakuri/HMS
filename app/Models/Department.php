<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $fillable = [
        'department_code',
        'department_name',
        'department_desc'
    ];

    public function doctors()
    {
        return $this->hasMany(Doctor::class,'department_id','id');
    }
}
