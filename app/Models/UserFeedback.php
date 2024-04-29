<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFeedback extends Model
{
    use HasFactory;
    protected $table = 'user_feedback';
    protected $fillable = [
        'fullname',
        'email',
        'subject',
        'message'
    ];
}
