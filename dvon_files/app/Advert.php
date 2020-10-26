<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    protected $fillable = [
        'advert', 'pages', 'position', 'advert_set_reference', 'subscription_id ', 'status', 'expired',
    ];
}
