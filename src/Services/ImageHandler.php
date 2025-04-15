<?php

namespace MrBohem\Laramage\Services;

use MrBohem\Laramage\Contracts\ImageHandlerInterface;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;
use Illuminate\Http\UploadedFile;
use Exception;

class ImageHandler implements ImageHandlerInterface
{
    protected ImageManager $manager;
    protected StorageService $storage;
    protected Image $image;

    protected string $originalPath;
    protected string $originalName;
    protected string $originalExtension;

    protected string $newName;
    protected string $newExtension;
    protected string $directory = '';
    protected string $filePath = '';

    public function __construct(ImageManager $manager, StorageService $storage)
    {
        $this->manager = $manager;
        $this->storage = $storage;
    }

    public function load(string|UploadedFile $source, string $disk = 'local'): self
    {
        if (is_string($source)) {
            if (!$this->storage->exists($disk, $source)) {
                throw new Exception("Image {$source} not found on disk {$disk}");
            }

            $this->originalPath = $this->storage->path($disk, $source);
            $this->directory = pathinfo($source, PATHINFO_DIRNAME);
            $this->image = $this->manager->read($this->originalPath);
        } elseif ($source instanceof UploadedFile) {
            $this->originalPath = $source->getClientOriginalName();
            $this->image = $this->manager->read($source->getRealPath());
        } else {
            throw new Exception('Invalid image source.');
        }

        $this->setProps();
        return $this;
    }

    public function convert(string $format): self
    {
        if (!method_exists($this->image, $format)) {
            throw new Exception("Format method {$format} does not exist.");
        }

        // Encode the image to desired format
        $encoded = $this->image->{$format}(); // Returns EncodedImage

        // Re-read the encoded data into an Image object
        $this->image = $this->manager->read($encoded); // Fix: now $this->image is again Intervention\Image\Image

        $this->newExtension = strtolower(substr($format, 2));

        return $this;
    }

    public function apply(string $method, ...$args): self
    {
        $result = call_user_func_array([$this->image, $method], $args);

        if ($result instanceof Image) {
            $this->image = $result;
        }

        return $this;
    }

    public function store(string $disk = 'local', ?string $directory = null, ?string $fileName = null, bool $unique = false): self
    {
        $this->newName = $fileName ?? ($unique ? uniqid() : $this->originalName);
        $this->directory = $directory ?? $this->directory;
        $this->filePath = trim("{$this->directory}/{$this->newName}.{$this->newExtension}", '/');

        $this->storage->put($disk, $this->filePath, (string) $this->image->encode());

        return $this;
    }

    public function getPath(): string
    {
        return $this->filePath;
    }

    public function getFileName():string
    {
        return "{$this->newName}.{$this->newExtension}";
    }

    public function getOnlyFileName():string
    {
        return $this->newName;
    }


    protected function setProps(): void
    {
        $this->originalName = pathinfo($this->originalPath, PATHINFO_FILENAME);
        $this->originalExtension = pathinfo($this->originalPath, PATHINFO_EXTENSION);
        $this->newName = $this->originalName;
        $this->newExtension = $this->originalExtension;
    }
}
