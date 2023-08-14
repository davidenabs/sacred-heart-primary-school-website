<?php

namespace App\Http\Livewire\Admin;

use App\Models\Blog\Category;
use App\Models\Gallery\Gallery;
use App\Traits\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class GalleryPost extends Component
{
    use WithFileUploads, UploadFile;

    public Gallery $gallery;
    public $images = [], $title, $description, $err, $page, $isAddPhoto;
    public $newImagesToAdd = [];

    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
    ];

    protected $listeners = ['addImage' => 'addImages'];

    public function mount($page, $gallery = null, $isAddPhoto = false)
    {

        $this->page = $page;
        $this->isAddPhoto = $isAddPhoto;

        if ($gallery) {
            $this->title = $gallery->title;
            $this->description = $gallery->description;
            $this->images = json_decode($gallery->photos);

            // dd(scandir(public_path('shs_images/gallery')));

            $storeFolder = public_path('shs_images/gallery');


            $files = scandir($storeFolder);                 //1
            if (false !== $files) {
                foreach ($files as $file) {
                    if ('.' != $file && '..' != $file) {       //2
                        $obj['name'] = $file;
                        $obj['size'] = filesize($storeFolder . '/' . $file);
                        $result[] = $obj;
                    }
                }

                $this->dispatchBrowserEvent('imgs', ['result' => $result]);
            }

            // dd($result);
        }
    }

    public function addImages($image)
    {
        if ($this->isAddPhoto) {
            array_push($this->newImagesToAdd, $image);
        } else {
            array_push($this->images, $image);
        }
    }

    public function upload()
    {
        $this->validate();

        $imagePathToSave = [];

        if ($this->images) {
            try {
                $slug = Gallery::generateUniqueSlug($this->title);
                foreach ($this->images as $key => $image) {
                    if (array_key_exists('dataURL', $image)) {
                        $imagePathToSave[] =  $this->uploadFile($image, Str::uuid(), 'shs_images/gallery');
                    }
                }

                $imagePathToSave = json_encode($imagePathToSave);

                $gallery = Gallery::create([
                    'title' => $this->title,
                    'slug' => $slug,
                    'photos' => $imagePathToSave,
                    'description' => $this->description
                ]);

                // Use transactions to wrap database operations
                DB::beginTransaction();

                // Save the post to the database
                $gallery->save();

                DB::commit();

                // $this->dispatchBrowserEvent(
                //     'showAlert',
                //     ['type' => 'success', 'message' => 'Uploaded successfully!']
                // );

                session()->flash('success', 'Gallery created and uploaded successfully!');

                $this->clear();

                return redirect()->route('admin.galleries.index');
            } catch (\Throwable $th) {
                DB::rollBack(); // Rollback the transaction if an error occurs
                $this->dispatchBrowserEvent(
                    'showAlert',
                    ['type' => 'error', 'message' => 'Something went wrong!!']
                );
            }
        } else {
            $this->err = 'Upload at least two image!';
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Upload at least one image!']
            );
        }
    }

    public function updateGallery()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $slug = Gallery::generateUniqueSlug($this->title);

            $gallery = [
                'title' => $this->title,
                'slug' => $slug,
                'description' => $this->description
            ];

            $this->gallery->update($gallery);

            // Save the post to the database
            $this->gallery->save();

            DB::commit();

            //  $this->dispatchBrowserEvent(
            //      'showAlert',
            //      ['type' => 'success', 'message' => 'Updated successfully!']
            //  );

            session()->flash('success', 'Updated successfully!');

            //  $this->clear();

            return redirect()->route('admin.galleries.index');
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback the transaction if an error occurs
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something went wrong!!']
            );
        }
    }

    public function addMorePhotos()
    {
        $imagePathToSave = [];

        // dd($this->images);
        try {
            if ($this->newImagesToAdd) {
                DB::beginTransaction();


                foreach ($this->newImagesToAdd as $image) {
                    if (array_key_exists('dataURL', $image)) {
                        $imagePathToSave[] =  $this->uploadFile($image, Str::uuid(), 'shs_images/gallery');
                    }
                }

                if ($this->images) {
                    $imagePathToSave =  array_merge($imagePathToSave, $this->images);
                }

                $imagePathToSave = json_encode($imagePathToSave);

                $this->gallery->update(['photos' => $imagePathToSave]);

                // Save the post to the database
                $this->gallery->save();

                DB::commit();

                //  $this->dispatchBrowserEvent(
                //      'showAlert',
                //      ['type' => 'success', 'message' => 'Photos added successfully!']
                //  );

                session()->flash('success', 'Photos added successfully!');

                //  $this->clear();

                return redirect()->route('admin.galleries.index');
            } else {
                $this->dispatchBrowserEvent(
                    'showAlert',
                    ['type' => 'error', 'message' => 'A mininum of photo is required!']
                );
            }
        } catch (\Throwable $th) {
            DB::rollBack(); // Rollback the transaction if an error occurs
            $this->dispatchBrowserEvent(
                'showAlert',
                ['type' => 'error', 'message' => 'Something went wrong!!']
            );
        }
    }

    public function clear()
    {
        $this->title = '';
        $this->description = '';
        $this->images = [];
    }

    public function render()
    {
        $categories = Category::latest()->get();
        return view('livewire.admin.gallery-post', ['categories' => $categories]);
    }
}
