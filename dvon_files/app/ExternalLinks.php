<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalLinks extends Model
{
    protected $fillable = [
        'link_name', 'link_image', 'link_url'
    ];
}
