<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    const STATUS_NOOWNER = 'No owner';
    const STATUS_INPROCESS = 'Granted owner';
    const STATUS_CONFIGDONE = 'In Process';
    const STATUS_REQUESTAPPROVAL = 'Request approval';
    const STATUS_APPROVED = 'Approved';

    protected $table = 'booth';

    public function owner() {
        return $this->belongsTo(Profile::class, 'ownerId');
    }

    public function zone_booths() {
        return $this->hasMany(Zone_Booth::class, 'boothId');
    }
}