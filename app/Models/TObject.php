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

    public function booth_objects() {
        return $this->hasMany(Booth_Object::class, 'objectId');
    }
}

