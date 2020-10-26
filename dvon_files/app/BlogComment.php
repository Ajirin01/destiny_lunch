<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{
    protected $fillable = [
        'user_id', 'comment', 'status'
    ];

    public function blogs(){
        return $this->belongsTo('App\Blog');
    }
}
