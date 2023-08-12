<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'meta_title',
        'meta_description',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function generateUniqueSlug($title, $categoryId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Exclude the current post (if provided) from the search query
        $query = Post::whereSlug($slug);
        if ($categoryId !== null) {
            $query->where('id', '!=', $categoryId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count++;
            // Update the query to check the new slug
            $query->whereSlug($slug);
        }

        return $slug;
    }
}
