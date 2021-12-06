<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    protected $table = 'scene';

    public function panoramas() {
        return $this->hasMany(Panorama::class, 'sceneId');
    }

}