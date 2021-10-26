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
    public function tour() {
        return $this->belongsTo(Tour::class, 'tourId');
    }
    public function booth() {
        return $this->belongsTo(Booth::class, 'boothId');
    }  
    public function object() {
        return $this->belongsTo(TObject::class, 'objectId');
    }
}
