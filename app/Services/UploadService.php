<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class UploadService
{

    public function saveImage(UploadedFile $file, string $path): string
    {
        $status = $file->storeAs("images/{$path}", $file->hashName(), 'public');
        if (!$status){
            throw new Exception('файл не загружен');
        }
        return $status;
    }
    public function deleteImage(string $path): string
    {
        $status = Storage::disk('public')->delete($path);
        if (!$status){
            throw new Exception('старое изображение не удалено');
        }
        return $status;
    }
}
