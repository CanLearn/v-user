<?php

namespace App\Repository\bank;

use App\Models\Panel\BankData;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;

class bankRepo
{

    public function index()
    {
        return BankData::query()->with('child')->orderByDesc('created_at')->get();
    }

    public function store($value)
    {
        return BankData::query()->create([
            'title' => $value->title,
            'slug' => SlugService::createSlug(BankData::class, 'slug', $value->title),
            'title_en' => $value->title_en,
            'slug_en' => SlugService::createSlug(BankData::class, 'slug', $value->title_en),
            'parent_id' => $value->parent_id,
            'user_id' => auth()->id(),
        ]);
    }

    public function getById($id)
    {
        return BankData::query()->findOrFail($id);
    }

    public function update($value, $id)
    {
        $BankDataId = $this->getById($id);
        return BankData::query()->where('id', $id)->update([
            'title' => $value->title ?? $BankDataId->title,
            'slug' => SlugService::createSlug(BankData::class, 'slug', $value->title ?? $BankDataId->title),
            'title_en' => $value->title_en ?? $BankDataId->title_en,
            'slug_en' => Str::slug($value->title_en ?? $BankDataId->title_en),
            'parent_id' =>  $value->parent_id,
            'user_id' => auth()->id(),
        ]);
    }
    public function delete($id)
    {
        $delete = $this->getById($id);
        return BankData::query()->where('id', $delete->id)->delete();
    }
    public function getTitleId($id)
    {
        return BankData::query()->where('id', $id)->first();
    }

    public function getArticleInBankData($BankData)
    {
        return BankData::query()->where('id', $BankData)->with('articles.author')->first();
    }

    public function getParentId()
    {
        return BankData::query()->where('parent_id', null)->with('parent')->get();
    }

    public function getByShowId($id)
    {
        return BankData::query()->where('id', $id)->with('child')->first();
    }

    public function getFindSlug($slug)
    {
        return BankData::query()->where('slug_en', $slug)->first();
    }
    public function getFindById($id)
    {
        return BankData::query()->where('id', $id)->get()->pluck('id');
    }

    public function getFindPesaon()
    {
        return BankData::query()->select([
            'title_en',
            'slug_en',
        ])->get();
    }
    public function getFindPesaonEn()
    {
        return BankData::query()->select([
            'title',
            'slug',
            'slug_en',
        ])->get();
    }
}
