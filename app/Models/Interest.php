<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;

class Interest extends Model
{
    protected $table = 'interest';
    public $timestamps = true;

    public function visitor() {
        return $this->belongsTo(Visitor::class, 'visitorId');
    }
}
