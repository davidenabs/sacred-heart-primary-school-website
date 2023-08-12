<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use App\Models\User;
use App\Notifications\Admin\PostCreatedNotification;
use App\Traits\OptimizeImage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Mews\Purifier\Facades\Purifier;

class BlogPost extends Component
{
    use WithFileUploads, OptimizeImage;

    public Post $post;
    public $page, $action;
    public $title, $content = '', $category, $image, $featured_image_path, $is_published = false, $is_draft = false;


    public function mount($page, $post = null)
    {
        $this->page = $page;
        if ($post) {
            $this->category = $post->category_id;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->featured_image_path = $post->featured_image;
            $this->is_published = $post->is_published;
            $this->is_draft = $post->is_draft;
        }
    }

    protected $messages = [
        'state.title.required' => 'The post title cannot be empty.',
        'state.content.required' => 'The post content is required.',
        'state.category.required' => 'The post category is required.',
        'state.image.required' => 'The post cover image is required.',
        'state.image.image' => 'Invalid image format.',
        'state.image.mimes' => 'The supported image formats are: webp, jpeg, png, jpg, and gif.',
        'state.image.max' => 'The maximum image size is 2MB.',
    ];


    public function store()
    {
        // dd($this->image);

        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            // 'is_published' => auth()->user()->isAdmin() ? 'required' : 'nullable',
            'image' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ]);

        $is_published = false;
        $is_draft = false;
        $msg = 'New Post Added Successfully!!';
        $slug = Post::generateUniqueSlug($this->title);

        $content = $this->content;
        $strippedContent = strip_tags($content);
        $summary = Str::limit($strippedContent, 160);
        $metaDescription = 'Meta Description: ' . Str::limit($strippedContent, 150);

        if (auth()->user()->isAdmin()) {
            $is_published = $this->is_published;
        } else {
            $is_published = false;
        }

        try {

            $content = $this->handleSummernoteFile($slug);

            // Use Eloquent's create method to create and save the new post
            $post = Post::create([
                'category_id' => $this->category,
                'author_id' => auth()->user()->id,
                'slug' => $slug,
                'title' => $this->title,
                'content' => $content,
                'summary' =>  $summary,
                'featured_image' => $this->uploadFile($slug),
                'meta_title' => 'Meta Title: ' . $this->title,
                'meta_description' => $metaDescription,
                'is_published' => $this->is_draft ? 0 : $is_published,
                'is_draft' => $this->is_published ? 0 : $this->is_draft,
                'published_at' => $is_published ? Carbon::now() : null,
            ]);

            if ($this->is_published) {
                $is_published = true;
                $msg = 'New Post Added And Published Successfully!!';
            } elseif ($this->is_draft) {
                $msg = 'Post Added To Draft Successfully!!';
            }

            // Use transactions to wrap database operations
            DB::beginTransaction();

            // Save the post to the database
            $post->save();

            DB::commit();

            // $this->dispatchBrowserEvent(
            //     'showAlert',
            //     ['type' => 'success', 'message' => $msg]
            // );

            session()->flash('success', $msg);

            // forward to admin
            if (!$this->is_draft && !auth()->user()->isAdmin()) {
                session()->flash('success', 'Forwarded to admin approval');
                // SEND MAIL TO ADMIN
                $admins = User::whereRole('ADM')->get();
                // dd($admins);
                Notification::send($admins, new PostCreatedNotification($post));
            }

            $this->clearFields();

            return redirect($this->page);
        } catch (\Throwable $th) {
            // dd($th);
            DB::rollBack(); // Rollback the transaction if an error occurs

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something went wrong!!']
            );
        }
    }


    public function updatePost()
    {
        $this->validate([
            'title' => 'required',
            'content' => 'required',
            'category' => 'required',
            'is_published' => auth()->user()->isAdmin() ? 'required' : 'nullable',
            'image' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ]);

        // Optimize summary and meta_description generation
        $content = $this->content;
        $strippedContent = strip_tags($content);
        $summary = Str::limit($strippedContent, 150);
        $metaDescription = 'Meta Description: ' . Str::limit($strippedContent, 150);

        try {
            // Start a database transaction
            DB::beginTransaction();

            $slug = $this->post->generateUniqueSlug($this->title, $this->post->id);

            $content = $this->handleSummernoteFile($slug);

            if ($this->image != null) {
                // Check if the file exists before attempting to delete it
                if (file_exists($this->post->featured_image)) {
                    unlink($this->post->featured_image);
                }
                $featured_image_path = $this->uploadFile($slug);
            } else {
                $featured_image_path = $this->post->featured_image;
            }

            // Update data in the database using the transaction
            $data = [
                'slug' => $slug,
                'category_id' => $this->category,
                'title' => $this->title,
                'summary' => $summary,
                'content' => $content,
                'featured_image' => $featured_image_path,
                'meta_title' => 'Meta Title: ' . $this->title,
                'meta_description' => $metaDescription,
                'is_published' => $this->is_draft ? 0 : $this->is_published,
                'is_draft' => $this->is_published ? 0 : $this->is_draft,
                'published_at' => $this->is_published && !$this->post->published_at ? Carbon::now() : $this->post->published_at,
            ];

            $this->post->update($data);

            // Commit the transaction if everything is successful
            DB::commit();

            session()->flash('success', 'Post Updated Successfully!!');

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Post Updated Successfully!!']
            );

            return redirect()->back();
        } catch (\Throwable $th) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            // dd($th);

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something went wrong!!']
            );
        }
    }

    public function uploadFile($titleSlug, $directory = 'shs_images/posts')
    {
        $featured_image = $titleSlug . '.' . $this->image->extension();

        // Specify the directory where the image will be stored
        // $directory = 'shs_images/posts';

        $imagePath = $this->image->storeAs($directory, $featured_image, 'real_public');

        $featured_image_path = $this->optimizeImage($imagePath);

        return $featured_image_path;
    }

    public function handleSummernoteFile($slug)
    {
        $content = $this->content;

        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');

            // Check if the image data is base64-encoded
            if (strpos($data, 'data:image') === 0) {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name = "/shs_images/posts/" . $slug . '-' . time() . $item . '.png';
                $path = public_path($image_name);
                file_put_contents($path, $imgeData);

                // Update the image src attribute to use the actual image URL
                $image->removeAttribute('src');
                $image->setAttribute('src', asset($image_name));
            }
        }

        return $dom->saveHTML();
    }

    public function clearFields()
    {
        $this->reset(['title', 'content', 'category', 'image', 'is_published']);
        $this->dispatchBrowserEvent('action', ['type' => 'clear']);
    }

    public function render()
    {
        $categories = Category::latest()->get();


        return view('livewire.admin.blog-post', [
            'categories' =>  $categories
        ]);
    }
}
