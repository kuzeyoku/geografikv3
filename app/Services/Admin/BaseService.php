<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function __construct(private readonly Model $model, private ModuleEnum $module)
    {
    }

    public function folder(): string
    {
        return $this->module->folder();
    }

    public function route(): string
    {
        return $this->module->route();
    }

    public function all()
    {
        return $this->model->orderByDesc("id")->paginate(config("pagination.admin", 15));
    }

    public function create(array $request): void
    {
        $item = $this->model->create($request);
        $this->translations($item, $request);
        if (method_exists($item, 'hasMedia')) {
            $fileService = new FileService("image");
            $fileService->upload($item, $request);
        }
        // Log::channel("custom_info")->info(auth()->user()->name . " tarafından bir " . $this->module->name . " içeriği oluşturuldu. " . $item->title);
    }

    public function update(array $request, Model $item): void
    {
        $item->update($request);
        $this->translations($item, $request);
        if (method_exists($item, 'hasMedia')) {
            $fileService = new FileService("image");
            $fileService->upload($item, $request);
        }
    }

    public function translations($item, $request): void
    {
        if (method_exists($item, 'translate')) {
            languageList()->each(function ($lang) use ($item, $request) {
                $item->translate()->updateOrCreate(
                    [
                        "lang" => $lang->code
                    ],
                    [
                        "title" => array_key_exists("title", $request) ? $request["title"][$lang->code] : null,
                        "description" => array_key_exists("description", $request) ? $request["description"][$lang->code] : null,
                        "tags" => array_key_exists("tags", $request) ? $request["tags"][$lang->code] : null,
                        "features" => array_key_exists("features", $request) ? $request["features"][$lang->code] : null,
                    ]
                );
            });
        }
    }

    public function statusUpdate($request, Model $item): bool
    {
        return $item->update($request);
    }

    public function delete(Model $item): ?bool
    {
        return $item->delete();
    }

    public function imageDelete(Model $item): ?bool
    {
        return $item->delete();
    }

    public function imageAllDelete(Model $item)
    {
        return $item->clearMediaCollection("images");
    }

    public function getCategories(): array
    {
        $categories = Category::whereStatus(StatusEnum::Active->value)
            ->when($this->module !== null, function ($query) {
                return $query->where("module", $this->module);
            })
            ->get();
        $titles = $categories->pluck("titles." . app()->getFallbackLocale(), "id");
        return $titles->toArray();
    }
}
