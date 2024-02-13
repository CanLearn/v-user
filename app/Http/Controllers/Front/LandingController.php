<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\category\categoryRepo;
use App\Repository\footer\footerRepo;
use App\Repository\images\imageRepo;
use App\Repository\main\mainRepo;
use App\Repository\Video\videoRepo;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index(mainRepo $mainRepo, videoRepo $videoRepo, imageRepo $imageRepo, footerRepo $footerRepo)
    {
        $mainRepo = $mainRepo->getAllLanding();
        $videoRepo = $videoRepo->getAllLanding();
        $imageRepo = $imageRepo->getAllLanding();
        $footerRepo = $footerRepo->getAllLanding();

        return [
            'mainRepo' => $mainRepo,
            'videoRepo' => $videoRepo,
            'imageRepo' => $imageRepo,
            'footerRepo' => $footerRepo,
        ];
    }

    public function category_product_en($slug, categoryRepo $categoryRepo)
    {
        $category = $categoryRepo->getFindSlug($slug);
        $products = $category->load(['products' => function ($q) {
            $q->where('is_default', 1)
                ->select([
                    'title_en',
                    'slug_en',
                    'summary_en',
                    'content_en',
                    'price_en',
                ])
                ->first();
        }]);

        return $products;

    }

    public function category_product_fa($slug, categoryRepo $categoryRepo)
    {
        $category = $categoryRepo->getFindSlug($slug);
        $products = $category->load(['products' => function ($q) {
            $q->where('is_default', 1)
                ->select([
                    'title',
                    'slug',
                    'summary',
                    'content',
                    'price',
                ])
                ->first();
        }]);

        return $products;

    }

    public function categoriesEn(categoryRepo $categoryRepo)
    {
        return $category = $categoryRepo->getFindPesaon();
    }

    public function categoriesFa(categoryRepo $categoryRepo)
    {
        return $category = $categoryRepo->getFindPesaonEn();
    }

    public function headerEn(mainRepo $mainRepo)
    {
        return $main = $mainRepo->getFindEn();
    }

    public function headerFa(mainRepo $mainRepo)
    {
        return $main = $mainRepo->getFindPersaon();
    }

    public function videoEn(videoRepo $videoRepo)
    {
        return $video = $videoRepo->getFindEn();
    }

    public function videoFa(videoRepo $videoRepo)
    {
        return $video = $videoRepo->getFindFa();
    }

    public function imageEn(imageRepo $imageRepo)
    {
        return $image = $imageRepo->getFindEn();
    }

    public function imageFa(imageRepo $imageRepo)
    {
        return $image = $imageRepo->getFindFa();
    }

    public function footerEn(footerRepo $footerRepo)
    {
        return $footer = $footerRepo->getFindEn();
    }

    public function footerFa(footerRepo $footerRepo)
    {
        return $footer = $footerRepo->getFindFa();
    }
}
