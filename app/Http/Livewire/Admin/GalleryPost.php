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
    public $images = [], $title, $description, $err, $page;

    protected $rules = [
        'title' => 'required|string',
        'description' => 'required|string',
    ];

    protected $listeners = ['addImage' => 'addImages'];

    public function mount($page, $gallery =null)
    {

        $this->page = $page;

        if ($gallery) {
            $this->title = $gallery->title;
            $this->description = $gallery->description;
            $this->images = json_decode($gallery->images);

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

                $this->dispatchBrowserEvent('imgs', ['result'=>$result]);
            }

            // dd($result);
        }
    }

    public function addImages($images)
    {
        array_push($this->images, $images);
    }

    public function upload()
    {
        $this->validate();

        if ($this->images) {

            try {
                $slug = Gallery::generateUniqueSlug($this->title);

                foreach ($this->images as $key => $image) {
                    $this->images[$key] =  $this->uploadFile($image, Str::uuid(), 'shs_images/gallery');
                }

                $this->images = json_encode($this->images);

                $gallery = Gallery::create([
                    'title' => $this->title,
                    'slug' => $slug,
                    'photos' => $this->images,
                    'description' => $this->description
                ]);

                // Use transactions to wrap database operations
                DB::beginTransaction();

                // Save the post to the database
                $gallery->save();

                DB::commit();

                $this->dispatchBrowserEvent(
                    'showAlert',
                    ['type' => 'success', 'message' => 'Uploaded successfully!']
                );

                $this->clear();

                return redirect($this->page);
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

             $this->dispatchBrowserEvent(
                 'showAlert',
                 ['type' => 'success', 'message' => 'Updated successfully!']
             );

            //  $this->clear();

            //  return redirect($this->page);
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

    // public $files = [];
    // public $currentStep = 1;
    // public $images  = [], $title, $description;


    // public function finishUpload($name, $tmpPath, $isMultiple)
    // {
    //     $this->cleanupOldUploads();

    //     $files = collect($tmpPath)->map(function ($i) {
    //         return TemporaryUploadedFile::createFromLivewire($i);
    //     })->toArray();
    //     $this->emitSelf('upload:finished', $name, collect($files)->map->getFilename()->toArray());

    //     $files = array_merge($this->getPropertyValue($name), $files);
    //     $this->syncInput($name, $files);
    // }

    // public function firstStepSubmit()
    // {
    //     $validatedData = $this->validate([
    //         'title' => 'required|string',
    //         'description' => 'required|string',
    //     ]);

    //     $this->currentStep = 2;
    // }

    // public function back($step)
    // {
    //     $this->currentStep = $step;
    // }

    // public function clear()
    // {
    //     $this->title = '';
    //     $this->description = '';
    // }


    // public function fileUpload($file)
    // {
    //     // Store the uploaded file and get its path
    //     $path = $file->store('files', 'public');

    //     // Add the file path to the list of uploaded files
    //     $this->images[] = $path;
    // }


    public function render()
    {
        $categories = Category::latest()->get();
        return view('livewire.admin.gallery-post', ['categories' => $categories]);
    }
}
