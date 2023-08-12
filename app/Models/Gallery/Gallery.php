<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'photos'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function galleryphotos()
    {
        return $this->hasMany(GalleryPhoto::class);
    }

    public static function generateUniqueSlug($title, $postId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Exclude the current post (if provided) from the search query
        $query = Gallery::whereSlug($slug);
        if ($postId !== null) {
            $query->where('id', '!=', $postId);
        }

        while ($query->exists()) {
            $slug = $originalSlug . '-' . $count++;
            // Update the query to check the new slug
            $query->whereSlug($slug);
        }

        return $slug;
    }
}
