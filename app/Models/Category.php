<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    public function topics(){
        return $this->hasMany(Topic::class);
    }




    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $slug = Str::slug($category->name);
                $count = static::where('slug', 'LIKE', "{$slug}%")->count();
                $category->slug = $count > 0 ? "{$slug}-" . ($count + 1) : $slug;
            }
        });
    }
}
