<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use App\Models\Profile;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    const LEVEL_VISITER = 10;
    const LEVEL_SPEAKER = 20;
    const LEVEL_PARTICIPANT = 30;
    const LEVEL_TOURADMIN = 40;
    const LEVEL_SUPERADMIN = 50;

    protected $table = 'users';
    public $timestamps = true;

    public function profile()
    {
        return $this->hasOne(Profile::class, 'userId');
    }
    
}
