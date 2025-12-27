<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Topic extends Model
{
    /** @use HasFactory<\Database\Factories\TopicFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'description',
        'slug',
        'views',
        'user_id',
        'category_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function views(){
        return $this->hasMany(TopicView::class);
    }

    public function bookmarks(){
        return $this->hasMany(Bookmark::class);
    }


}
