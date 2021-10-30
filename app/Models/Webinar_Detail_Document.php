<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Webinar;
use App\Models\Profile;

class Webinar_Detail_Document extends Model
{
    protected $table = 'webinar_detail_document';
    public $timestamps = true;

    public function webinar() {
        return $this->belongsTo(Webinar::class, 'webinarDetailId');
    }

    public function document() {
        return $this->belongsTo(Document::class, 'documentId');
    }
}
