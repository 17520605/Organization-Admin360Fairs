<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar_Detail;

class Webinar extends Model
{
    protected $table = 'webinar';
    public $timestamps = true;

    public function details() {
        return $this->hasMany(Webinar_Detail::class, 'webinarId');
    }
}
