<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempData extends Model
{
    protected $fillable = [
        'email', 'subscription_id'
    ];
}
