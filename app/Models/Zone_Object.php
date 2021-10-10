<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone;
use App\Models\Booth;
use App\Models\TObject;

class Zone_Object extends Model
{
    protected $table = 'zone_object';

    public function zone() {
        return $this->belongsTo(Zone::class, 'zoneId');
    }

    public function object() {
        return $this->belongsTo(TObject::class, 'objectId');
    }
}