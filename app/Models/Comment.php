<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comment';

    public function visitor() {
        return $this->belongsTo(Visitor::class, 'visitorId');
    }
}