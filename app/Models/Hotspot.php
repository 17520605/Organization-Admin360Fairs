<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $table = 'hotspot';

    public function asset() {
        return $this->belongsTo(Asset::class, 'assetId');
    }
}
