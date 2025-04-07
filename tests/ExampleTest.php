<?php

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Drivers\Gd\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;
use MrBohem\Laramage\Laramage;
use Intervention\Image\Image as InterventionImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

// uses(\Illuminate\Foundation\Testing\TestCase::class)->in('Feature', 'Unit');

beforeEach(function () {
    Storage::fake('local');
    $manager = new ImageManager(Driver::class);
    $image = $manager->create(1000, 1000)->fill('red');
    Storage::disk('local')->put('test.png', (string) $image->encode(new WebpEncoder(quality: 10)));
    test()->fakeImageFilename = 'test.png';
});

it('can save file to storage desire folder', function () {
    // (new Laramage)->get(test()->fakeImageFilename)->store(directory:'dummydir');

    Laramage::handler()
        ->load(test()->fakeImageFilename)
        ->store(directory: 'processed');

    Storage::disk('local')->assertExists('processed/'.test()->fakeImageFilename);
});

it('can upload file with unique file name', function () {
    $fileName = Laramage::handler()
    ->load(test()->fakeImageFilename)
    // ->convert('toWebp')
    // ->apply('scale', 600, 600)
    ->store(directory: 'processed',unique:true)
    ->getFileName();

    Storage::disk('local')->assertExists('processed/'.$fileName);
});

it('can convert file to webp format', function () {
    Laramage::handler()
    ->load(test()->fakeImageFilename)
    ->convert('toWebp')
    ->store(directory: 'processed');

    Storage::disk('local')->assertExists('processed/test.webp');
});

it('can scale image using intervention methods', function () {
    Laramage::handler()
    ->load(test()->fakeImageFilename)
    ->apply('scale', 600, 600)
    ->store(directory: 'processed');

    Storage::disk('local')->assertExists('processed/'.test()->fakeImageFilename);

    $manager = new ImageManager(Driver::class);
    $image = $manager->read(Storage::disk('local')->path('processed/'.test()->fakeImageFilename));

    expect($image->width())->toBe(600);
    expect($image->height())->toBe(600);
});