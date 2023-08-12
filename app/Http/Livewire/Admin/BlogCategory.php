<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog\Category;
use Livewire\Component;
use Illuminate\Support\Str;

class BlogCategory extends Component
{
    public Category $category;
    public $title, $description;

    protected $rules = [
        'title' => 'required|string',
        'description' => 'nullable|string',
    ];

    public function mount($category = null)
    {
        if ($category) {
            $this->title = $category->title;
            $this->description = $category->description;
        }
    }

    public function store()
    {
        $this->validate();

        try {
            $category = new Category();

            $category->title = $this->title;
            $category->slug = $category->generateUniqueSlug($this->title);
            $category->description = $this->description;
            $category->meta_title = 'Meta Title: ' . $this->title;
            $category->meta_description = 'Meta Description: ' . Str::limit(strip_tags($this->description), 150);

            $category->save();

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Category Created Successfully!']
            );

            $this->clearFields();
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something goes wrong!!']
            );
        }
    }

    public function updateCategory()
    {
        $this->validate();

        try {

            $data = [
                'title' => $this->title,
                'slug' => $this->category->generateUniqueSlug($this->title),
                'description' => $this->description,
                'meta_title' => 'Meta Title: ' . $this->title,
                'meta_description' => 'Meta Description: ' . Str::limit(strip_tags($this->description), 150),
            ];

            $this->category->update($data);

            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'success', 'message' => 'Category Updated Successfully!']
            );

            $this->clearFields();

            return to_route('admin.categories.index');

        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something goes wrong!!']
            );
        }
    }

    public function clearFields()
    {
        $this->reset(['title', 'description']);
    }


    public function render()
    {
        return view('livewire.admin.blog-category');
    }
}
