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

    public function create_two($value,  $product)
    {
        return $this->query->where('id', $product->id)->update([
            'content' => $value->content,
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
            $q->select(['id', 'title'])->get();
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


    public function update_one($value, $id)
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
            'user_id' => auth()->id()
        ]);
    }

    public function update_two($value, $product, $multi_image, $video_url, $oldImage, $oldVideo)
    {
        $newImageJson = !empty($multi_image) ? json_encode($multi_image) : null;
        $oldImageJson = !empty($oldImage->multi_image) ? json_encode($oldImage->multi_image) : null;

        $mergedImagesArray = null;

        if (!empty($multi_image) && !empty($oldImageJson)) {
            $mergedImagesArray = array_merge(json_decode($oldImageJson, true), $multi_image);
        } elseif (empty($multi_image) && !empty($oldImageJson)) {
            $mergedImagesArray = json_decode($oldImageJson, true);
        } elseif (!empty($multi_image) && empty($oldImageJson)) {
            $mergedImagesArray = $multi_image;
        }

        $newVideoJson = !empty($video_url) ? json_encode($video_url) : null;
        $oldVideoJson = !empty($oldVideo->video_url) ? json_encode($oldVideo->video_url) : null;
        $mergedVideoArray = null;
        if (!empty($video_url) && !empty($oldVideoJson)) {
            $mergedVideoArray = array_merge(json_decode($oldVideoJson, true), $video_url);
        } elseif (empty($video_url) && !empty($oldVideoJson)) {
            $mergedVideoArray = json_decode($oldVideoJson, true);
        } elseif (!empty($video_url) && empty($oldVideoJson)) {
            $mergedVideoArray = $video_url;
        }
        $mergedImages = !empty($mergedImagesArray) ? json_encode($mergedImagesArray) : null;
        $mergedVideo = !empty($mergedVideoArray) ? json_encode($mergedVideoArray) : null;
        return $this->query->where('id', $product->id)->update([
            'content' => $value->content,
            'multi_image' => $mergedImages,
            'video_url' => $mergedVideo,
        ]);
    }

    public function update_three($value, $product, $multi_image, $video_url, $oldImage, $oldVideo)
    {
        // dd( $multi_image  , $video_url, $oldImage, $oldVideo);
        $newImageJson = !empty($multi_image) ? json_encode($multi_image) : null;
        $oldImageJson = !empty($oldImage->multi_image_en) ? json_encode($oldImage->multi_image_en) : null;
        $mergedImagesArray = null;
        if (!empty($multi_image) && !empty($oldImageJson)) {
            $mergedImagesArray = array_merge(json_decode($oldImageJson, true), $multi_image);
        } elseif (empty($multi_image) && !empty($oldImageJson)) {
            $mergedImagesArray = json_decode($oldImageJson, true);
        } elseif (!empty($multi_image) && empty($oldImageJson)) {
            $mergedImagesArray = $multi_image;
        }

        $oldVideoJson = !empty($oldVideo->video_url_en) ? json_encode($oldVideo->video_url_en) : null;
        $mergedVideoArray = null;

        if (!empty($video_url) && !empty($oldVideoJson)) {
            $mergedVideoArray = array_merge(json_decode($oldVideoJson, true), $video_url);
        } elseif (empty($video_url) && !empty($oldVideoJson)) {
            $mergedVideoArray = json_decode($oldVideoJson, true);
        } elseif (!empty($video_url) && empty($oldVideoJson)) {
            $mergedVideoArray = $video_url;
        }
        $mergedImages = !empty($mergedImagesArray) ? json_encode($mergedImagesArray) : null;
        $mergedVideos =  !empty($mergedVideoArray) ? json_encode($mergedVideoArray) : null;

        return $this->query->where('id', $product->id)->update([
            'content_en' => $value->content_en,
            'multi_image_en' => $mergedImages,
            'video_url_en' => $mergedVideos,
        ]);

    }

    public function status($id, $status)
    {
        return Product::query()->where('id', $id)->update([
            'status_price' => $status
        ]);
    }

    public function getImageForeach(mixed $image)
    {
        return Product::query()->where('multi_image', $image)->get();
    }

    public function getFindProducts($id)
    {
        return Product::query()->where('id', $id)->first();
    }
}
