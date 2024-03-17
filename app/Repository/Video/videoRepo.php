<?php

namespace App\Repository\Video;

use App\Models\Panel\Videolanding;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class videoRepo
{
    public function index()
    {
        return Videolanding::query()->orderByDesc('created_at')->paginate();
    }
    public function store_one($data)
    {
        return Videolanding::query()->create([
            'title' => $data['title'],
            'slug' => SlugService::createSlug(Videolanding::class, 'slug', $data['title']),
            'content' => $data['content'],
            'title_en' => $data['title_en'],
            'slug_en' => Str::slug($data['title_en']),
            'content_en' => $data['content_en'],
            'user_id' => 1
        ]);
    }
    public function store_two($id , $video_en, $duration_en)
    {
        return Videolanding::query()->where('id' , $id)->update([
            'video_en' => $video_en,
            'duration_en' => $duration_en,
        ]);
    }
    public function store_three($id , $video, $duration)
    {
        return Videolanding::query()->where('id' , $id)->update([
            'video' => $video,
            'duration' => $duration,
        ]);
    }
    public function getFindId($is)
    {
        return Videolanding::query()->findOrFail($is);
    }
    public function delete($id)
    {
        return Videolanding::query()->where('id', $id)->delete();
    }
    public function getAllLanding()
    {
        return Videolanding::query()->get();
    }
    public function getFindEn()
    {
        return Videolanding::query()->select([
            'title_en',
            'slug_en',
            'video_en',
            'content_en',
            'duration_en'
        ])->get();
    }
    public function getFindFa()
    {
        return Videolanding::query()->select([
            'title',
            'slug',
            'video',
            'content',
            'duration'

        ])->get();
    }
    public function update_one($data, $id)
    {
        return Videolanding::query()->where('id', $id->id)->update([
            'title' => $data['title'] ?? $id->title,
            'slug' => SlugService::createSlug(Videolanding::class, 'slug', $data['title'] ?? $id->title),
            'content' => $data['content'] ?? $id->content,
            'title_en' => $data['title_en'] ?? $id->title_en,
            'slug_en' => Str::slug($data['title_en'] ?? $id->title_en),
            'content_en' => $data['content_en'] ?? $id->content_en,
            'user_id' => 1
        ]);
    }
    public function update_two($id , $video_en, $duration_en)
    {
        return Videolanding::query()->where('id' , $id->id)->update([
            'video_en' => $video_en ?? $id->$video_en ,
            'duration_en' => $duration_en ?? $id->$duration_en ,
        ]);
    }

    public function update_three($id , $video, $duration)
    {
        return Videolanding::query()->where('id' , $id->id)->update([
            'video' => $video ?? $id->$video,
            'duration' => $duration ?? $id->$duration,
        ]);
    }
}



//    public function update($data, $id, $video, $video_en, $duration, $duration_en)
//    {
//        return Videolanding::query()->where('id', $id->id)->update([
//            'title' => $data['title'] ?? $id->title,
//            'slug' => SlugService::createSlug(Videolanding::class, 'slug', $data['title'] ?? $id->title),
//            'video' => $video ?? $id->video,
//            'content' => $data['content'] ?? $id->content,
//            'title_en' => $data['title_en'] ?? $id->title_en,
//            'slug_en' => Str::slug($data['title_en'] ?? $id->title_en),
//            'video_en' => $video_en ?? $id->video_en,
//            'content_en' => $data['content_en'] ?? $id->content_en,
//            'duration' => $duration,
//            'duration_en' => $duration_en,
//            'user_id' => 1
//        ]);
//    }

//    public function store($data, $video, $video_en, $duration, $duration_en)
//    {
//        return Videolanding::query()->create([
//            'title' => $data['title'],
//            'slug' => SlugService::createSlug(Videolanding::class, 'slug', $data['title']),
//            'video' => $video,
//            'content' => $data['content'],
//            'title_en' => $data['title_en'],
//            'slug_en' => Str::slug($data['title_en']),
//            'video_en' => $video_en,
//            'content_en' => $data['content_en'],
//            'duration' => $duration,
//            'duration_en' => $duration_en,
//            'user_id' => 1
//        ]);
//    }
