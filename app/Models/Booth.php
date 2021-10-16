<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{

    const STATUS_INPROCESS = 'In Process';
    const STATUS_CONFIGDONE = 'Config Done';

    protected $table = 'booth';
    
}

