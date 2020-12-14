<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExternalLinks extends Model
{
    protected $fillable = [
        'link_name', 'link_url', 'link_intro_background', 'link_intro_description'
    ];
}
