<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TObject extends Model
{
    protected $table = 'object';
    public $timestamps = true;

    public function owner() {
        return $this->belongsTo(Profile::class, 'ownerId');
    }
}

