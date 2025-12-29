<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $fillable = [
        'topic_id',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function topic(){
        return $this->belongsTo('App\Models\Topic');
    }
}
