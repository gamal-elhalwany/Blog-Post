<?php

namespace App\Traits;

use App\Models\Category;

trait Taggable
{
    public function getTags()
    {
        $categories = Category::with('tags')->get();
        $tags = [];

        foreach ($categories as $category) {
            foreach ($category->tags as $tag) {
                $tags[] = $tag;
            }
        }

        return [$tags];
    }
}
