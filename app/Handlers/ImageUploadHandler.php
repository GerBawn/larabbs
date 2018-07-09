<?php

namespace App\Handlers;

use function in_array;
use Intervention\Image\Facades\Image;
use function public_path;
use function str_random;
use function strtolower;

class ImageUploadHandler
{
    protected $allowedExt = ['png', 'jpeg', 'gif', 'jpg'];

    public function save($file, $folder, $prefix, $maxWidth = false)
    {
        $folderName = "uploads/images/{$folder}/" . date('Ym/d', time());

        $uploadPath = public_path() . '/' . $folderName;

        $extension = strtolower($file->getClientOriginalExtension()) ?: 'png';

        $filename = $prefix . '_' . time() . '_' . str_random(10) . '.' . $extension;

        if (!in_array($extension, $this->allowedExt)) {
            return false;
        }

        $file->move($uploadPath, $filename);

        if ($maxWidth && $extension !== 'gif') {
            $this->reduceSize($uploadPath . '/' . $filename, $maxWidth);
        }

        return [
            'path' => config('app.url') . "/$folderName/$filename",
        ];
    }

    public function reduceSize($filePath, $maxWidth)
    {
        $image = Image::make($filePath);
        $image->resize(
            $maxWidth,
            null,
            function ($constraint) {
                $constraint->aspectRatio();

                $constraint->upsize();
            }
        );

        $image->save();
    }
}