<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Booth;
use App\Models\TObject;

class Booth_Object extends Model
{
    protected $table = 'booth_object';

    public function booth() {
        return $this->belongsTo(Booth::class, 'boothId');
    }

    public function object() {
        return $this->belongsTo(TObject::class, 'objectId');
    }
}