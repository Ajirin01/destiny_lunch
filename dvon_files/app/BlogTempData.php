<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogTempData extends Model
{
    protected $fillable = [
        'email', 'blog_reference', 'subscription_id'
    ];
}
