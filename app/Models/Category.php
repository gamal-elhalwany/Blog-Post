<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'slug', 'description', 'parent_id'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,
        'category_tag',
        'category_id',
        'tag_id',
        'id',
        'id',
    );
    }

    public static function booted()
    {
        static::creating(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function getDefaultImageAttribute()
    {
        if (!$this->image) {
            return 'https://www.incathlab.com/images/products/default_product.png';
        }
        if (Str::startsWith($this->image, ['https://', 'http:/'])) {
            return $this->image;
        }
        return asset('storage/' . $this->image);
    }
}
