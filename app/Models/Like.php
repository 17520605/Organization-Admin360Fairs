<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visitor;

class Like extends Model
{
    protected $table = 'like';

    public function visitor() {
        return $this->belongsTo(Visitor::class, 'visitorId');
    }
}

