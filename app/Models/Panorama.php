<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone_Booth;

class Panorama extends Model
{
    protected $table = 'panorama';
    public $timestamps = true;

    public function hotspots() {
        return $this->hasMany(Hotspot::class, 'panoramaId');
    }

    public function asset() {
        return $this->belongsTo(Asset::class, 'assetId');
    }
}
