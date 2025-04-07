<?php

namespace MrBohem\Laramage;

use App;
use App\Services\ImageOptimizationService;
use App\Services\ImageUploadService;
use App\Services\S3Service;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use MrBohem\Laramage\Commands\LaramageCommand;

class LaramageServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laramage')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->singleton('laramage', function ($app) {
            return new Laramage();
        });
    }
    public function packageBooted(): void
    {
    }
}
