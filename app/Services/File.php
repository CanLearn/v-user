<?php

namespace App\Services;

use Illuminate\Support\Str;

class File
{
    public static function video_peo_en($videos)
    {
        $fileName = [];
        if (!is_array($videos)) {
            $videos = [$videos];
        }
        foreach ($videos as $video) {
            $video_en  = Str::random(15) . ' . ' . $video->getClientOriginalName();
            $video->storeAs('files/products/en/', $video_en , 'public_image_products_en');
            $fileName[] = $video_en ;
        }
        return $fileName;
    }

    public static function video_peo($videos)
    {
        $fileName = [];
        if (!is_array($videos)) {
            $videos = [$videos];
        }
        foreach ($videos as $video) {
            $video_en  = Str::random(15) . ' . ' . $video->getClientOriginalName();
            $video->storeAs('files/products/fa/', $video_en , 'public_image_products');
            $fileName[] = $video_en ;
        }
        
        return $fileName;
    }

    public static function image_en($multi_image_en)
    {
        $fileName = [];
        if (!is_array($multi_image_en)) {
            $multi_image_en = [$multi_image_en];
        }
        foreach ($multi_image_en as $image) {
            $imageName_en = Str::random(15) . '.' . $image->getClientOriginalName();
            $image->move(public_path('images/products/en/'), $imageName_en);
            $fileName[] = $imageName_en ;
        }
        return $fileName;
    }

    public static function image($multi_image)
    {
        $fileName = [];
        if (!is_array($multi_image)) {
            $multi_image = [$multi_image];
        }

        foreach ($multi_image as $image) {
            $imageName = Str::random(15) . '.' . $image->getClientOriginalName();
            $image->move(public_path('images/products/fa/'), $imageName);
            $fileName[] = $imageName;
        }

        return $fileName;
    }
}


/**
 * sesion 1 : title , titile en  , proce en fa , category , support  , summary en fa , 
 * sesion 2: video fa content fa imgae fa 
 * sesion 3:  video en content en imgae en 
 */
