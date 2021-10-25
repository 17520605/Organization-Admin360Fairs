<?php

namespace App\Models;

use BenSampo\Enum\Enum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Profile;
use App\Models\Tour;

class Tour_Partner extends Model
{
    const UNCONFIRMED = 'unconfirmed';
    const SENTEMAIL = 'sent email';
    const CONFIRMED = 'confirmed';
    const JOINED = 'joined';

    protected $table = 'tour_partner';
    public $timestamps = true;

    public function tour() {
        return $this->belongsTo(Tour::class, 'tourId');
    }

    public function partner() {
        return $this->belongsTo(Profile::class, 'partnerId');
    }
}
