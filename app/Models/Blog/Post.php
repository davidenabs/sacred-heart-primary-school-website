<?php

namespace App\Models\Blog;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Post extends Model
{
    use HasFactory, SoftDeletes, HasSEO;

    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'summary',
        'content',
        'featured_image',
        'views',
        'likes',
        'shares',
        'commentable',
        'meta_title',
        'meta_description',
        'is_published',
        'is_draft',
        'published_at',
        'deleted_at',
        'notified',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id')->withTrashed();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('is_published', false);
    }

    public function scopeDraft($query)
    {
        return $query->where('is_draft', true);
    }

    public function scopeUndraft($query)
    {
        return $query->where('is_draft', false);
    }

    public function scopeEditor($query)
    {
        return $query->where('author_id', auth()->user()->id);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    /**
     * scope query for searched results
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */

    public function scopeSearched($query)
    {
        $search = request()->query('search');

        if (!$search) {
            return $query->published();
        }

        // Modify the scope to include pagination conditions
        return $query->published()
            ->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('content', 'LIKE', "%{$search}%");
            });
    }


    public function scopeSearch($query, $search)
    {
        $search = '%' . $search . '%';
        return $query->where('title', 'LIKE', $search);
    }


    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            if (!auth()->user()) {
                $builder->where('is_published', true);
            }
        });

        static::addGlobalScope('draft', function (Builder $builder) {
            if (!auth()->user()) {
                $builder->where('is_draft', false);
            }
        });

        static::deleting(function ($post) {
            // Extract image URLs from the post content
            preg_match_all('/<img[^>]+src="([^">]+)"/', $post->content, $matches);

            if (!empty($matches[1])) {
                foreach ($matches[1] as $imageUrl) {
                    // Remove the base URL and leading slash from the image URL
                    $imageUrl = str_replace(asset('/'), '', $imageUrl);

                    // Delete the image file from the public directory
                    if (File::exists(public_path($imageUrl))) {
                        File::delete(public_path($imageUrl));
                    }
                }
            }
        });
    }


    public static function generateUniqueSlug($title, $postId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $count = 1;

        // Exclude the current post (if provided) from the search query
        $query = Post::whereSlug($slug);
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

    public function getDynamicSEOData(): SEOData
    {
        return new SEOData(
            title: $this->title,
            description: $this->summary,
            author: 'Sacred Heart Primary School Kaduna',
            image: $this->featured_image,
            url: url(route('blog.show', $this->slug))
        );
    }
}
