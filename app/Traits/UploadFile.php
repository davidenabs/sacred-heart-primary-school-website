<?php

namespace App\Traits;

/**
 * optimize images
 */
trait UploadFile
{
    use OptimizeImage;

    public function uploadFile($data, $titleSlug, $directory = 'shs_images/posts')
    {
        // Convert the dataURL to a file instance
        $fileData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data['dataURL']));
        $tmpFilePath = sys_get_temp_dir() . '/' . uniqid() . '.jpg';
        file_put_contents($tmpFilePath, $fileData);
        $file = new \Illuminate\Http\UploadedFile($tmpFilePath, 'uploaded_file.jpg', null, null, true);

        $featured_image = $titleSlug . '.' . $file->extension();

        $imagePath = $file->storeAs($directory, $featured_image, 'real_public');

        $featured_image_path = $this->optimizeImage($imagePath);

        // Delete the temporary file
        unlink($tmpFilePath);

        return $featured_image_path;
    }
}
