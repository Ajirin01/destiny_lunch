<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'blog_owner_id',
        'blog_slug',
        'blog_title',
        'blog_image',
        'blog_description'
    ];

    public function likes(){
        return $this->hasMany('App\BlogLike');
    }
    public function comments(){
        return $this->hasMany('App\BlogComment');
    }
}
