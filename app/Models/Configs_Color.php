<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Configs_Color extends Model {
    
    protected $table = 'configs_color';

    protected $fillable = [
       'id',
       'color1',
       'color2',
       'color3',
       'color4',
       'created_at',
       'updated_at'
    ];
}
