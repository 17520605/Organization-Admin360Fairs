<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $table = 'asset';
    public $timestamps = true;

    public function miniUrl()
    {
        if($this->url != null && $this->url != ""){
            if(strpos($this->url, 'res.cloudinary.com/virtual-tour/image/upload/') >= 0){
                $miniUrl = str_replace('upload/', 'upload/c_thumb,w_350,g_face/', $this->url);
                return $miniUrl;
            }
        }
        return $this->url;
    }
}