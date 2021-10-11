<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Profile;

class WebinarDetail extends Model
{
    protected $table = 'webinar_detail';
    public $timestamps = true;

    public function webinar() {
        return $this->belongsTo(Webinar::class, 'webinarId');
    }

    public function speaker() {
        return $this->belongsTo(Profile::class, 'speakerId');
    }
}
