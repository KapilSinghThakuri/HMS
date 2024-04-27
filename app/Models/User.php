<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, TwoFactorAuthenticatable, HasRoles;

    protected $table = 'users';
    protected $fillable = [
        'username' ,
        'email',
        'password',
        'address',
        'phone',
    ];
    protected $pivots = 'roles';
    public function doctor()
    {
        return $this->hasOne(Doctor::class,'user_id','id');
    }
}