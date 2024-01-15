<?php

namespace App\Repository\products;

use App\Models\Panel\Product;

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
            'slug'  => $value->slug,
            'slug_en'  => $value->slug_en,
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
            'user_id' => auth()->id()
        ]) ;
    }

    public function getFindId($id)
    {
        return $this->query->findOrFail($id) ;
    }

    public function update($value , $id )
    {
        $id = $this->getFindId($id);
        return $this->query->where('id' , $id->id)->update([

        ]) ;
    }

    public function delete($id)
    {
        return $this->query->where('id' , $id->id)->delete() ;
    }
}
