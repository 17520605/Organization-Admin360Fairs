<?php namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Article extends Model {
    
    protected $table = 'article';

    protected $fillable = [
       'id',
       'title',
       'slug',
       'name',
       'banner',
       'shortDescription',
       'content',
       'author',
       'isPublic',
       'created_at',
       'updated_at'
    ];
}
