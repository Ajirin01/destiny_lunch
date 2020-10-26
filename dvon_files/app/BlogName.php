<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogName extends Model
{
    protected $fillable = [
        'blog_owner_id',
        'blog_name',
        'blog_logo',
        'blog_reference',
        'subscription_id',
        'blog_status',
        'expired',
    ];

    public function blogs(){
        return $this->hasMany('App\Blog');
    }
}
