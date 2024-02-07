<?php

namespace App\Repository\images;

use App\Models\Panel\Imagelanding;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class imageRepo
{
    public function index()
    {
        return Imagelanding::query()->orderByDesc('created_at')->paginate();
    }

    public function store($data, $video, $video_en)
    {
        return Imagelanding::query()->create([
            'title' => $data['title'],
            'slug' => SlugService::createSlug(Imagelanding::class, 'slug', $data['title']),
            'image' => $video,
            'content' => $data['content'],
            'title_en' => $data['title_en'],
            'slug_en' => Str::slug($data['title_en']),
            'image_en' => $video_en,
            'content_en' => $data['content_en'],
            'user_id' => auth()->user()->id
        ]);
    }

    public function getFindId($is)
    {
        return Imagelanding::query()->findOrFail($is);
    }

    public function update($data, $id, $video, $video_en)
    {
        $image = $this->getFindId($id);
        return Imagelanding::query()->where('id', $id)->update([
            'title' => $data['title'] ?? $image->title,
            'slug' => SlugService::createSlug(Imagelanding::class, 'slug', $data['title'] ?? $image->title),
            'image' => $video ?? $image->image,
            'content' => $data['content'] ?? $image->content,
            'title_en' => $data['title_en'] ?? $image->title_en,
            'slug_en' => Str::slug($data['title_en'] ?? $image->title_en),
            'image_en' => $video_en ?? $image->image_en,
            'content_en' => $data['content_en'] ?? $image->content_en,
            'user_id' => auth()->user()->id
        ]);
    }

    public function delete($id)
    {
        return Imagelanding::query()->where('id', $id)->delete();
    }

    public function getAllLanding()
    {
        return Imagelanding::query()->get();
    }

    public function getFindEn()
    {
        return Imagelanding::query()->select([
            'title_en',
            'slug_en',
            'image_en',
            'content_en',
        ])->get();
    }

    public function getFindFa()
    {
        return Imagelanding::query()->select([
            'title',
            'slug',
            'image',
            'content',
        ])->get();

    }
}
