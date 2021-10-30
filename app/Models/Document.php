<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'document';
    public $timestamps = true;

    public function owner() {
        return $this->belongsTo(Profile::class, 'ownerId');
    }

    public function webinar_detail_documents() {
        return $this->hasMany(Webinar_Detail_Document::class, 'documentId');
    }
}
