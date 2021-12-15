<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone_Booth;

class Zone extends Model
{
    protected $table = 'zone';

    public function booths() {
        return $this->hasMany(Booth::class, 'zoneId');
    }
}
