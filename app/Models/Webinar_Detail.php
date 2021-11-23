<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Profile;

class Webinar_Detail extends Model
{
    protected $table = 'webinar_detail';
    public $timestamps = true;

    public function webinar() {
        return $this->belongsTo(Webinar::class, 'webinarId');
    }

    public function speaker() {
        return $this->belongsTo(Speaker::class, 'speakerId');
    }

}
