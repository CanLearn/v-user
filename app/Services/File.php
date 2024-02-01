<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
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
            $video_en = Str::random(15) . ' . ' . $video->getClientOriginalName();
            $video->storeAs('files/products/en/', $video_en, 'public_image_products_en');
            $fileName[] = $video_en;
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
            $video_en = Str::random(15) . ' . ' . $video->getClientOriginalName();
            $video->storeAs('files/products/fa/', $video_en, 'public_image_products');
            $fileName[] = $video_en;
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
            $fileName[] = $imageName_en;
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

    public static function video_landing($video)
    {
        $video_en = Str::random(15) . ' . ' . $video->getClientOriginalName();
        $video->storeAs('files/video/', $video_en, 'public_image_products');
        return $video_en;
    }

    public static function video_en_landing($video)
    {
        $video_en = Str::random(15) . ' . ' . $video->getClientOriginalName();
        $video->storeAs('files/video/en/', $video_en, 'public_image_products');
        return $video_en;
    }

    public static function image_landing( $image)
    {
        $video_en = Str::random(15) . ' . ' . $image->getClientOriginalName();
        $image->move(public_path('images/image_landing/') , $video_en);
        return $video_en;
    }

    public static function image_en_landing( $image_en)
    {
        $IamgePath = Str::random(15) . ' . ' . $image_en->getClientOriginalName();
        $image_en->move(public_path('images/image_en_landing/') , $IamgePath);
        return $IamgePath;
    }

    public static function image_en_main( $image)
    {
        $imagePath = Str::random(15) . ' . ' . $image->getClientOriginalName();
        $image->move(public_path('images/image_main_landing/') , $imagePath);
        return $imagePath;
    }
}

