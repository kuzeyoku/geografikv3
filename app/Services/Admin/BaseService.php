<?php

namespace App\Services\Admin;

use App\Models\Category;
use App\Enums\ModuleEnum;
use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function __construct(private Model $model, private ModuleEnum $module) {}

    public function folder()
    {
        return $this->module->folder();
    }

    public function route()
    {
        return $this->module->route();
    }

    public function module()
    {
        return $this->module;
    }

    public function all()
    {
        return $this->model->orderByDesc("id")->paginate(config("pagination.admin", 15));
    }

    public function create(array $request)
    {
        $item = $this->model->create($request);
        $this->translations($item, $request);
        if (method_exists($item, 'hasMedia')) {
            $fileService = new FileService("image", $this->module->COVER_COLLECTION());
            $fileService->upload($item, $request);
        }
        // Log::channel("custom_info")->info(auth()->user()->name . " tarafından bir " . $this->module->name . " içeriği oluşturuldu. " . $item->title);
    }

    public function update(array $request, Model $item)
    {
        $item->update($request);
        $this->translations($item, $request);
        if (method_exists($item, 'hasMedia')) {
            $fileService = new FileService("image", $this->module->COVER_COLLECTION());
            $fileService->upload($item, $request);
        }
    }

    public function translations($item, $request)
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
                    ]
                );
            });
        }
    }

    public function statusUpdate($request, Model $item)
    {
        return $item->update($request);
    }

    public function delete(Model $item)
    {
        return $item->delete();
    }

    public function imageDelete(Model $item)
    {
        return $item->delete();
    }

    public function imageAllDelete(Model $item)
    {
        return $item->clearMediaCollection($this->module->IMAGE_COLLECTION());
    }

    public function getCategories()
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
