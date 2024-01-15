<?php

namespace App\Repository\category;

use App\Models\Panel\Category;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class categoryRepo
{

    public function index()
    {
        return Category::query()->with('child')->orderByDesc('created_at')->get();
    }

    public function store($value)
    {
        return Category::query()->create([
            'title' => $value->title,
            'slug' => SlugService::createSlug(Category::class, 'slug', $value->title),
            'parent_id' => $value->parent_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function getById($id)
    {
        return Category::query()->findOrFail($id);
    }

    public function update($value, $id)
    {
        return Category::query()->where('id', $id->id)->update([
            'title' => $value->title,
            'slug' => SlugService::createSlug(Category::class, 'slug', $value->title),
            'parent_id' => $value->parent_id,
            'user_id' => auth()->user()->id,
        ]);
    }
    public function delete($id)
    {
        $delete = $this->getById($id);
        return Category::query()->where('id', $delete->id)->delete();
    }
    public function getTitleId($id)
    {
        return Category::query()->where('id', $id)->first();
    }

    public function getArticleInCategory($category)
    {
        return Category::query()->where('id' , $category)->with('articles.author')->first();
    }
}
