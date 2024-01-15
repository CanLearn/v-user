<?php

namespace App\Services;

use Illuminate\Support\Str;

class File
{
    public static function video_peo($videos)
    {
        foreach ($videos as $video) {
            $imageName = Str::random(15) . ' . ' . $video->getClientOriginalName();
            $video->storeAs('files/products/fa/', $imageName , 'public_image_products');
        }
        return $imageName ;
    }

    public static function video_peo_en($videos)
    {
        foreach ($videos as $video) {
            $imageName = Str::random(15) . ' . ' . $video->getClientOriginalName();
            $video->storeAs('files/products/en/', $imageName , 'public_image_products_en');
        }
        return $imageName ;
    }

    public static function image_en( $video_url_en)
    {
        foreach ($video_url_en as $imageEn) {
            $imageName = Str::random(15) . ' . ' . $imageEn->getClientOriginalName();
            $imageEn->move(public_path('images/products/en/') , $imageName);
            $fileNames_en[] = $imageName;
        }

        return $fileNames_en ;
    }

    public static function image( $multi_image)
    {
        foreach ($multi_image as $image) {
            $imageName = Str::random(15) . ' . ' . $image->getClientOriginalName();
            $image->move(public_path('images/products/fa/') , $imageName);
            $fileNames[] = $imageName;
        }
        return $fileNames ;

    }
}
