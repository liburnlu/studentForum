<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    /** @use HasFactory<\Database\Factories\TopicFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'content',
        'slug',
        'views',
        'user_id',
        'category_id',
    ];





    protected static function boot()
    {
        parent::boot();

        static::creating(function ($topic) {
            if (empty($topic->slug)) {
                $slug = Str::slug($topic->title);
                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $topic->slug = $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
            }
        });
    }

}
