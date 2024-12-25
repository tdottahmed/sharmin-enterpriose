<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadFile')) {
    function uploadFile($file, $directory)
    {
        if (!$file) {
            return null;
        }
        Storage::makeDirectory($directory);
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs($directory, $fileName, 'public');
        return $filePath;
    }
}

if (!function_exists('deleteFile')) {
    function deleteFile($filePath)
    {
        Storage::delete($filePath);
    }
}

if (!function_exists('getFilePath')) {
    function getFilePath($path)
    {
        if ($path) {
            return asset('storage/' . $path);
        } else {
            return asset('limitless/global_assets/images/placeholders/404-Illustration.png');
        }
    }
}
