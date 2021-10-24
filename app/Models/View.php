<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visitor;

class View extends Model
{
    protected $table = 'view';

    public function visitor() {
        return $this->belongsTo(Visitor::class, 'visitorId');
    }
}

