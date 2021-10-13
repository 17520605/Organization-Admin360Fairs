<?php

namespace App\Models;

use BenSampo\Enum\Enum;
use Illuminate\Database\Eloquent\Model;
use App\Models\Zone_Booth;
use App\Models\User;
use App\Models\Tour;

class Tour_Participant extends Model
{
    const UNCONFIRMED = 'unconfirmed';
    const SENTEMAIL = 'sent email';
    const CONFIRMED = 'confirmed';
    const JOINED = 'joined';

    protected $table = 'tour_participant';
    public $timestamps = true;

    public function tour() {
        return $this->belongsTo(Tour::class, 'tourId');
    }

    public function participant() {
        return $this->belongsTo(Profile::class, 'participantId');
    }
}
