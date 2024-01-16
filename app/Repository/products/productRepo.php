<?php

namespace App\Repository\products;

use App\Models\Panel\Category;
use App\Models\Panel\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Psy\Util\Str;

class productRepo
{
    private $query ;
    public function __construct(){
      $this->query = Product::query() ;
    }

    public function index()
    {
        return $this->query->orderByDesc('created_at')->paginate() ;
    }

    public function create($value , $multi_image , $multi_image_en , $video_url , $video_url_en )
    {
        return $this->query->create([
            'title'  => $value->title,
            'title_en'  => $value->title_en,
            'slug' => SlugService::createSlug(Product::class, 'slug', $value->title),
            'slug_en'  => str()->slug($value->slug_en),
            'summary'  => $value->summary,
            'summary_en'  => $value->summary_en,
            'content'  => $value->content,
            'content_en'  => $value->content_en,
            'multi_image'  => $multi_image,
            'multi_image_en'  => $multi_image_en,
            'video_url'  => $video_url,
            'video_url_en'  => $video_url_en,
            'price'  => $value->price,
            'price_en'  => $value->price_en,
            'status_price' => Product::STATUS_PRICE_DISABLE,
            'user_id' => 1
        ]) ;
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id) ;
    }

    public function update($value , $id  , $multi_image , $multi_image_en , $video_url , $video_url_en )
    {
        $id = $this->getFindId($id);
        return $this->query->where('id' , $id->id)->update([
            'title'  => $value->title ? $value->title : $id->title,
            'title_en'  => $value->title_en ? $value->title_en : $id->title_en,
            'slug' => SlugService::createSlug(Product::class, 'slug', $value->title ? $value->title : $id->title),
            'slug_en'  => \str()->slug($value->title ? $value->slug_en : $id->title),
            'summary'  => $value->summary ? $value->summary : $id->summary,
            'summary_en'  => $value->summary_en ? $value->summary_en : $id->summary_en,
            'content'  => $value->content ? $value->content : $id->content,
            'content_en'  => $value->content_en ? $value->content_en : $id->content_en,
            'multi_image'  => $multi_image,
            'multi_image_en'  => $multi_image_en,
            'video_url'  => $video_url,
            'video_url_en'  => $video_url_en,
            'price'  => $value->price ? $value->price : $id->price,
            'price_en'  => $value->price_en ? $value->price_en : $id->price_en,
            'status_price' => Product::STATUS_PRICE_DISABLE,
            'user_id' => 1
        ]) ;
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id->id)->delete() ;
    }
}
