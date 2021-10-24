<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\View;

class Visitor extends Model
{
    protected $table = 'visitor';

    public function views() {
        return $this->hasMany(View::class, 'visitorId');
    }
}
