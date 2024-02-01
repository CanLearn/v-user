<?php

namespace App\Repository\main;

use App\Models\Panel\Mainlanding;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class mainRepo
{
    public function index()
    {
        return Mainlanding::query()->paginate();
    }

    public function store($data, $image)
    {
        return Mainlanding::query()->create([
            'title' => $data['title'],
            'title_en' => $data['title_en'],
            'image' => $image,
            'sub_title' => $data['sub_title'],
            'sub_title_en' => $data['sub_title_en'],
            'content' => $data['content'],
            'content_en' => $data['content_en'],
        ]);
    }

    public function getFindId($is)
    {
        return Mainlanding::query()->findOrFail($is);
    }

    public function update($data, $id, $image)
    {
        $id = $this->getFindId($id);
        return Mainlanding::query()->where('id', $id->id)->update([
            'title' => $data['title'] ?? $id->title,
            'title_en' => $data['title_en'] ?? $id->title_en,
            'image' => $image ?? $image,
            'sub_title' => $data['sub_title'] ?? $id->sub_title_en,
            'sub_title_en' => $data['sub_title_en'] ?? $id->sub_title_en,
            'content' => $data['content'] ?? $id->content,
            'content_en' => $data['content_en'] ?? $id->content_en,
        ]);
    }

    public function delete($id)
    {
        return Mainlanding::query()->where('id', $id)->delete();
    }
}
