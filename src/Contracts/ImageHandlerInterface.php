<?php

namespace MrBohem\Laramage\Contracts;

use Illuminate\Http\UploadedFile;

interface ImageHandlerInterface
{
    public function load(string|UploadedFile $source, string $disk = 'local'): self;
    public function convert(string $format): self;
    public function apply(string $method, ...$args): self;
    public function store(string $disk = 'local', ?string $directory = null, ?string $fileName = null, bool $unique = false): self;
    public function getPath(): string;
    public function getFileName(): string;
    public function getOnlyFileName(): string;
    
}
