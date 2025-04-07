<?php

namespace MrBohem\Laramage\Factories;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageManagerFactory
{
    public static function create(): ImageManager
    {
        return new ImageManager(new Driver());
    }
}
