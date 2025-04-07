<?php

namespace MrBohem\Laramage\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    public function exists(string $disk, string $path): bool
    {
        return Storage::disk($disk)->exists($path);
    }

    public function path(string $disk, string $path): string
    {
        return Storage::disk($disk)->path($path);
    }

    public function put(string $disk, string $path, string $content): void
    {
        Storage::disk($disk)->put($path, $content);
    }
}
