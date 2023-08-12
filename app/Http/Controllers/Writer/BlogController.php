<?php

namespace App\Http\Controllers\Writer;

use App\Http\Controllers\Controller;
use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($type = 'posts')
    {
        $posts = Post::editor()->latest()->get();
        $draft_posts = Post::editor()->draft()->latest()->get();
        $pending_posts = Post::editor()->unpublished()->latest()->get();
        $trash_posts = Post::editor()->onlyTrashed()->latest()->get();

        $postsCount = $posts->count();
        $draftCount = $draft_posts->count();
        $pendingCount = $pending_posts->count();
        $trashCount = $trash_posts->count();

        if ($type === 'draft') {
            $posts = $draft_posts;
        } elseif ($type === 'pending') {
            $posts = $pending_posts;
        } elseif ($type === 'trash') {
            $posts = $trash_posts;
        } else {
            $posts = $posts;
        }
        // dd($type == 'trash' ? true : false);

        $data = [
            'posts' => $posts,
            'postsCount' => $postsCount,
            'draftCount' => $draftCount,
            'pendingCount' =>  $pendingCount,
            'trashCount' =>  $trashCount,
            'is_trash' => $type == 'trash' ? true : false
        ];

        return view('writer.blog.index', $data);
    }

    public function showPostsByCategory(Category $category)
    {
        $posts = Post::editor()->latest()->get();
        $draft_posts = Post::editor()->draft()->latest()->get();
        $pending_posts = Post::editor()->unpublished()->latest()->get();
        $trash_posts = Post::editor()->onlyTrashed()->latest()->get();

        $postsCount = $posts->count();
        $draftCount = $draft_posts->count();
        $pendingCount = $pending_posts->count();
        $trashCount = $trash_posts->count();

        $data = [
            'posts' => $category->posts()->editor()->orderBy('created_at', 'desc')->get(),
            'postsCount' => $postsCount,
            'draftCount' => $draftCount,
            'pendingCount' =>  $pendingCount,
            'trashCount' =>  $trashCount,
            'is_trash' => false
        ];

        return view('writer.blog.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('writer.blog.create');
    }

    public function show($post)
    {
        $post = $this->getPost($post);

        return view('writer.blog.show', compact('post'));
    }

    public function showComments($post)
    {
        $post = $this->getPost($post);

        return view('writer.blog.show-comments', compact('post'));
    }

    public function showAnalytics($post)
    {
        $post = $this->getPost($post);

        return response()->json([
            'views' => $post->views,
            'shares' => $post->shares,
            'comments' => $post->comments()->count()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('writer.blog.create', compact('post'));
    }

    public function undraftPost(Request $request, $post)
    {
        $post = $this->getPost($post);

        $updatePost = ['is_draft' => false];

        $post->update($updatePost);

        if ($request->wantsJson()) {
            return response()->json('Post undrafted successfully!');
        } else {
            return redirect()->back()->with('success', 'Post undrafted successfully!');
        }
    }

    public function destroy(Request $request, Post $post)
    {
        // unlink($post->featured_image);

        $post->delete();

        if ($request->wantsJson()) {
            return response()->json('Post moved to trash successfully!');
        } else {
            return redirect()->route('writer.blog.index')->with('success', 'Post moved to trash successfully!');
        }
    }

    public function forceDestroy(Request $request, $post)
    {
        $post = $this->getPost($post);

        unlink($post->featured_image);

        $post->forceDelete();

        if ($request->wantsJson()) {
            return response()->json('Post deleted successfully!');
        } else {
            return redirect()->route('writer.blog.index')->with('success', 'Post deleted successfully!');
        }
    }

    public function restore($post)
    {
        $post = $this->getPost($post);

        $post->restore();

        session()->flash('success', 'Post restored successfully!');

        return redirect()->back();
    }

    protected function getPost($postSlug, $withTrashed = false): Post
    {
        if ($withTrashed) {
            $post = Post::editor()->withTrashed()->whereSlug($postSlug)->firstOrFail();
        } else {
            $post = Post::editor()->withoutTrashed()->whereSlug($postSlug)->firstOrFail();
        }

        return $post;
    }

    public static function formatNumber($num)
    {
        if($num > 1000) {

            $x = round($num);
            $x_number_format = number_format($x);
            $x_array = explode(',', $x_number_format);
            $x_parts = array('k', 'm', 'b', 't');
            $x_count_parts = count($x_array) - 1;
            $x_display = $x;
            $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
            $x_display .= $x_parts[$x_count_parts - 1];

            return $x_display;

        }

        return $num;
    }




}
