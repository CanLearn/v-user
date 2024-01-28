<?php

namespace App\Repository\products;

use App\Models\Panel\Category;
use App\Models\Panel\Product;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

            'category_id' => $category->id,
            'price' => $value->price,
            'price_en' => $value->price_en,
        ]);
    }
    public function create_three($value, $product, $multi_image, $multi_image_en)
    {
        return $this->query->where('id', $product->id)->update([
            'content_en' => $value->content_en,
            'multi_image' => $multi_image,
            'multi_image_en' => $multi_image_en,
        ]);
    }

    public function create_four($product, $multi_image, $multi_image_en)
    {
        return $this->query->where('id', $product->id)->update([
            'video_url' => $multi_image,
            'video_url_en' => $multi_image_en,
        ]);
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id);
    }

    public function findSupportId($id)
    {
       return $this->query->where('id', $id)->with(['supports' => function ($q) {
            return $q->select(['id', 'title'])->get();
        }])->first();
    }

    // public function update($value, $id, $multi_image, $multi_image_en, $video_url, $video_url_en, $category)
    // {
    //     return $this->query->where('id', $id->id)->update([
    //         'title' => $value->title,
    //         'title_en' => $value->title_en,
    //         'slug' => SlugService::createSlug(Product::class, 'slug', $value->title),
    //         'slug_en' => str()->slug($value->title_en),
    //         'summary' => $value->summary,
    //         'summary_en' => $value->summary_en,
    //         'content' => $value->content,
    //         'content_en' => $value->content_en,
    //         'multi_image' => $multi_image,
    //         'multi_image_en' => $multi_image_en,
    //         'video_url' => $video_url,
    //         'video_url_en' => $video_url_en,
    //         'price' => $value->price,
    //         'price_en' => $value->price_en,
    //         'status_price' => Product::STATUS_PRICE_DISABLE,
    //         'category_id' => $category->id,
    //         'user_id' => 1
    //     ]);
    // }

    public function delete($id)
    {
        return $this->query->where('id', $id->id)->delete();
    }



    public function update_one($value, $id, $category)
    {
        return $this->query->where('id', $id->id)->update([
            'title' => $value->title ?? $id->title,
            'title_en' => $value->title_en ?? $id->title_en,
            'slug' => SlugService::createSlug(Product::class, 'slug', $value->title ?? $id->title),
            'slug_en' => str()->slug($value->title_en ?? $id->title_en),
            'summary' => $value->summary ?? $id->summary,
            'summary_en' => $value->summary_en ?? $id->summary_en,
            'price' => $value->price ?? $id->price,
            'price_en' => $value->price_en ?? $id->price_en,
            'category_id' => $category->id,
            'user_id' => auth()->id()
        ]);
    }
    public function update_two($value,  $product, $multi_image, $video_url)
    {

        return $this->query->where('id', $product->id)->update([
            'content' => $value->content,
            'multi_image' => $multi_image,
            'video_url' => $video_url,

        ]);
    }
    public function update_three($value,  $product, $multi_image_en, $video_url_en)
    {
        return $this->query->where('id', $product->id)->update([
            'content_en' => $value->content_en,
            'multi_image_en' => $multi_image_en,
            'video_url_en' => $video_url_en,
        ]);
    }
}
/**
 * sesion 1 : title , titile en  , proce en fa , category , support  , summary en fa , 
 * sesion 2: video fa content fa imgae fa 
 * sesion 3:  video en content en imgae en 
 */
