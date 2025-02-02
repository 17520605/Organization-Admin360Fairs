<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar_Detail;

class Webinar extends Model
{
    const STATUS_UNCONFIRM = 'unconfirm';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_REJECTED = 'rejected';

    protected $table = 'webinar';
    public $timestamps = true;

    public function speakers() {
        return $this->hasMany(Speaker::class, 'webinarId');
    }

    public function details() {
        return $this->hasMany(Webinar_Detail::class, 'webinarId');
    }

    public function registrant() {
        return $this->belongsTo(Profile::class, 'registerBy');
    }
}
