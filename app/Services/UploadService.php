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

    /**
     * @param string|null $path
     * @return bool
     */
    public function deleteImage(?string $path): bool
    {
            return Storage::disk('public')->delete($path);

    }
}
