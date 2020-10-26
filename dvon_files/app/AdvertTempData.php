<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertTempData extends Model
{
    protected $fillable = [
        'email', 'advert_set_reference', 'subscription_id'
    ];
}
