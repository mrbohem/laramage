<?php

namespace MrBohem\Laramage\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MrBohem\Laramage\Laramage
 */
class Laramage extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laramage';
    }
}
