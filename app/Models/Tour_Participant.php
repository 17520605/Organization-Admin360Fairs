<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Zone_Booth;
use App\Models\User;
use App\Models\Tour;

class Tour_Participant extends Model
{
    protected $table = 'tour_participant';
    public $timestamps = true;

    public function tour() {
        return $this->belongsTo(Tour::class, 'tourId');
    }

    public function participant() {
        return $this->belongsTo(Profile::class, 'participantId');
    }
}
