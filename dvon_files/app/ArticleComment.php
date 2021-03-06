<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArticleComment extends Model
{
    protected $fillable = [
        'user_id', 'comment', 'status'
    ];

    public function articles(){
        return $this->belongsTo('App\Article');
    }
}
