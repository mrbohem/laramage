<?php

namespace MrBohem\Laramage;

// use Illuminate\Http\UploadedFile;
// use Illuminate\Support\Facades\Facade;
// use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Laravel\Facades\Image;
// use LaramageInterface;
// use Src\Services\Storage\StorageFactory;
// use Storage;
// use function PHPUnit\Framework\isInstanceOf;
// use Intervention\Image\Image as InterventionImage;


use MrBohem\Laramage\Factories\ImageManagerFactory;
use MrBohem\Laramage\Services\ImageHandler;
use MrBohem\Laramage\Services\StorageService;

class Laramage{
    public static function handler(): ImageHandler
    {
        return new ImageHandler(ImageManagerFactory::create(), new StorageService());
    }
}
