<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Profile;

class Webinar_Speaker extends Model
{
    protected $table = 'webinar_speaker';

    public function webinar() {
        return $this->belongsTo(Webinar::class, 'webinarId');
    }

    public function speaker() {
        return $this->belongsTo(Profile::class, 'speakerId');
    }
}

