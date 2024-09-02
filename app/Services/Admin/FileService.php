<?php

namespace App\Services\Admin;

use Illuminate\Support\Str;

class FileService
{
    public function __construct(private string $input, private string $collection) {}

    public function upload($item, $request)
    {
        if (array_key_exists("imageDelete", $request)) {
            $this->delete($item);
        }
        if (array_key_exists($this->input, $request) && $request[$this->input]->isValid()) {
            if ($item->hasMedia($this->collection)) {
                $this->delete($item);
            }
            $item->addMediaFromRequest($this->input)->usingFileName(Str::random(8) . "." . $request[$this->input]->extension())->toMediaCollection($this->collection);
        }
    }

    public function delete($item)
    {
        $item->clearMediaCollection($this->collection);
    }
}
