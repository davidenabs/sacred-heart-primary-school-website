<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;

/**
 * optimize images
 */
trait OptimizeImage
{
    public function optimizeImage($imagePath, $width = null, $height = null)
    {
        // Open the image file using Intervention Image
        $image = Image::make($imagePath);

        // Resize the image if width and height are provided
        if ($width && $height) {
            $image->fit($width, $height);
        }

        // Set the quality of the image (0-100)
        // Lower quality means smaller file size but may reduce image quality
        $optimizedImagePath = pathinfo($imagePath, PATHINFO_DIRNAME) . '/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';
        $image->encode('webp', 40)->save($optimizedImagePath);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Return the optimized image file path
        return $optimizedImagePath;
    }

    // public function uploadFile($image, $imageName, $directory = 'shs_images/posts')
    // {
    //     $image = $imageName . '.' . $image->extension();

    //     $imagePath = $image->storeAs($directory, $image, 'real_public');

    //     $image_path = $this->optimizeImage($imagePath);

    //     return $image_path;
    // }


    // public function optimizeImage($imagePath, $width = null, $height = null)
    // {
    //     // Open the image file using Intervention Image
    //     $image = Image::make($imagePath);

    //     // Resize the image if width and height are provided
    //     if ($width && $height) {
    //         $image->fit($width, $height);
    //     }

    //     // Set the quality of the image (0-100)
    //     // Lower quality means smaller file size but may reduce image quality
    //     $image->encode('webp', 40); // Adjust the quality as per your requirement

    //     // Save the optimized image back to the original file path
    //     // Save the optimized image in WebP format
    //     $imagePath = explode('.', $imagePath);
    //     $optimizedImagePath = $imagePath[0] . '.webp';
    //     $image->save($optimizedImagePath);

    //     // Return the optimized image file path
    //     return $optimizedImagePath;
    // }
}
