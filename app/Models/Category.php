<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function booted()
    {
        static::creating(function(Category $category){
            $category->slug = Str::slug($category->name);
        });
    }
}
