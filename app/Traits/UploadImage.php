<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

trait UploadImage
{
    public function uploadImage($image, $folder)
    {
        $image_name = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs($folder, $image_name, 'public');

        return $imagePath;
    }

    public function DeleteImage($image)
    {
        if (file_exists(public_path('storage/' . $image))) {
            unlink(public_path('storage/' . $image));
        }
    }
}
