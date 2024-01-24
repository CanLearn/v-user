<?php

namespace App\Repository\products;

use App\Models\Panel\Category;
use App\Models\Panel\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Psy\Util\Str;

class productRepo
{
    private $query;
    public function __construct()
    {
        $this->query = Product::query();
    }
    public function index()
    {
        return $this->query->orderByDesc('created_at')->paginate();
    }
    public function create_one($value)
    {
        return $this->query->create([
            'title' => $value->title,
            'title_en' => $value->title_en,
            'slug' => SlugService::createSlug(Product::class, 'slug', $value->title),
            'slug_en' => str()->slug($value->title_en),
            'summary' => $value->summary,
            'summary_en' => $value->summary_en,
            'user_id' => auth()->id()
        ]);
    }
    public function create_two($value, $category, $product)
    {
        return $this->query->where('id', $product->id)->update([
            'content' => $value->content,
            'content_en' => $value->content_en,
            'category_id' => $category->id,
            'price' => $value->price,
            'price_en' => $value->price_en,
        ]);
    }
    public function create_three($product, $multi_image, $multi_image_en)
    {
        return $this->query->where('id', $product->id)->update([
            'multi_image' => $multi_image,
            'multi_image_en' => $multi_image_en,
        ]);
    }

    public function create_four($product, $multi_image, $multi_image_en)
    {
        return $this->query->where('id', $product->id)->update([
            'multi_image' => $multi_image,
            'multi_image_en' => $multi_image_en,
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function update($value, $id, $multi_image, $multi_image_en, $video_url, $video_url_en, $category)
    {
        return $this->query->where('id', $id->id)->update([
            'title' => $value->title,
            'title_en' => $value->title_en,
            'slug' => SlugService::createSlug(Product::class, 'slug', $value->title),
            'slug_en' => str()->slug($value->title_en),
            'summary' => $value->summary,
            'summary_en' => $value->summary_en,
            'content' => $value->content,
            'content_en' => $value->content_en,
            'multi_image' => $multi_image,
            'multi_image_en' => $multi_image_en,
            'video_url' => $video_url,
            'video_url_en' => $video_url_en,
            'price' => $value->price,
            'price_en' => $value->price_en,
            'status_price' => Product::STATUS_PRICE_DISABLE,
            'category_id' => $category->id,
            'user_id' => 1
        ]);
    }

    public function delete($id)
    {
        return $this->query->where('id', $id->id)->delete();
    }

    //    public function create($value , $multi_image , $multi_image_en , $video_url , $video_url_en ,$category )
//    {
//        return $this->query->create([
//            'title'  => $value->title,
//            'title_en'  => $value->title_en,
//            'slug' => SlugService::createSlug(Product::class, 'slug', $value->title),
//            'slug_en'  => str()->slug($value->title_en),
//            'summary'  => $value->summary,
//            'summary_en'  => $value->summary_en,
//            'content'  => $value->content,
//            'content_en'  => $value->content_en,
//            'multi_image'  => $multi_image,
//            'multi_image_en'  => $multi_image_en,
//            'video_url'  => $video_url,
//            'video_url_en'  => $video_url_en,
//            'price'  => $value->price,
//            'price_en'  => $value->price_en,
//            'status_price' => Product::STATUS_PRICE_DISABLE,
//            'category_id' => $category->id ,
//            'user_id' => auth()->id()
//        ]) ;
//    }
}
