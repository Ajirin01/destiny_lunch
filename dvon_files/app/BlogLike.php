<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogLike extends Model
{
    protected $fillable = [
        'user_id', 'like', 'status'
    ];

    public function blogs(){
        return $this->belongsTo('App\Blog');
    }
}
