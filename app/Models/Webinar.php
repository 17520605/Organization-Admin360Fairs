<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\WebinarDetail;

class Webinar extends Model
{
    protected $table = 'webinar';
    public $timestamps = true;

    public function details() {
        return $this->hasMany(WebinarDetail::class, 'webinarId');
    }
}
