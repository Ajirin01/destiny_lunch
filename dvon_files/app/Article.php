<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'article_type',
        'article_title',
        'article_intro_image',
        'article_intro',
        'article_description'
    ];

    public function likes(){
        return $this->hasMany('App\Like');
    }
    public function comments(){
        return $this->hasMany('App\ArticleComment');
    }
}
