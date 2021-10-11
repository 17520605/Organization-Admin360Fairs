<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone_Booth;
use App\Models\User;

class Profile extends Model
{
    protected $table = 'profile';
    public $timestamps = true;

    public function user() {
        return $this->belongsTo(User::class, 'userId');
    }

}
