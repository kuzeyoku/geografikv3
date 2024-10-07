<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;

class FileService
{
    public function __construct(private string $input, private array $request, private string $collection = "default")
    {
    }

    public function upload($item): void
    {
        $excludeCollection = ["images", "documents"];
        if (array_key_exists("imageDelete", $this->request) || !in_array($this->collection, $excludeCollection)) {
            $item->clearMediaCollection($this->collection);
        }
        $item->addMediaFromRequest($this->input)->usingFileName(Str::random(8) . "." . $this->request[$this->input]->extension())->toMediaCollection($this->collection);
    }
}
