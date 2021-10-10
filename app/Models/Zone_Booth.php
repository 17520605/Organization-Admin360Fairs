<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone;
use App\Models\Booth;

class Zone_Booth extends Model
{
    protected $table = 'zone_booth';

    public function zone() {
        return $this->belongsTo(Zone::class, 'zoneId');
    }

    public function booth() {
        return $this->belongsTo(Booth::class, 'boothId');
    }
}

