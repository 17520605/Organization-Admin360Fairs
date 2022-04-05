<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Image;

class StorageService {

    public static function getUrl($id)
    {
        $asset = \App\Models\Asset::find($id);
        if(isset($asset)){
            return $asset->url;
        }
        return '';
    }

}
