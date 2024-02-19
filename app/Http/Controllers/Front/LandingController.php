<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repository\bank\bankRepo;
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
                    'multi_image_en',
                    'video_url_en',
                ])
                ->first();
        }]);
        return $products;
    }

    public function category_product_fa($slug, categoryRepo $categoryRepo)
    {
        $category = $categoryRepo->getFindSlug($slug);
        $products =  $category->load(['products' => function ($q) {
            $q->where('is_default', 1)
                ->select([
                    'title',
                    'slug',
                    'summary',
                    'content',
                    'price',
                    'multi_image',
                    'video_url',
                ])
                ->first();
        }]);

        return $products;
    }

    public function bank_data_product_en($slug, bankRepo $bankRepo)
    {
        $bank = $bankRepo->getFindSlug($slug);
        $products =  $bank->load(['products' => function ($q) {
            $q->where('is_default', 1)
                ->select([
                    'title_en',
                    'slug_en',
                    'summary_en',
                    'content_en',
                    'price_en',
                    'multi_image_en',
                    'video_url_en',
                ])
                ->first();
        }]);
        return $products;
    }

    public function bank_data_product_fa($slug, bankRepo $bankRepo)
    {
        $category = $bankRepo->getFindSlug($slug);
        $products =  $category->load(['products' => function ($q) {
            $q->where('is_default', 1)
                ->select([
                    'title',
                    'slug',
                    'summary',
                    'content',
                    'price',
                    'multi_image',
                    'video_url',
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


    public function bankdata_en(bankRepo $bankRepo)
    {
        return $banks = $bankRepo->getFindPesaon();
    }

    public function bankdata_fa(bankRepo $bankRepo)
    {
        return $banks = $bankRepo->getFindPesaonEn();
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

    public function category_product_main_en($slug, categoryRepo $categoryRepo)
    {
        $products = $categoryRepo->getFindSlug($slug)
            ->products()
            ->where('is_default', 0)
            ->select([
                'title_en',
                'slug_en',
                'summary_en',
                'content_en',
                'price_en',
                'multi_image_en',
                'video_url_en',
            ])
            ->get();

        return $products;
    }

    public  function category_product_main_fa($slug, categoryRepo $categoryRepo)
    {
        $products = $categoryRepo->getFindSlug($slug)
            ->products()
            ->where('is_default', 0)
            ->select([
                'title',
                'slug',
                'summary',
                'content',
                'price',
                'multi_image',
                'video_url',
            ])
            ->get();

        return $products;
    }

    public  function bank_data_product_main_fa($slug, bankRepo $bankRepo)
    {
        $products = $bankRepo->getFindSlug($slug)
            ->products()
            ->where('is_default', 0)
            ->select([
                'title',
                'slug',
                'summary',
                'content',
                'price',
                'multi_image',
                'video_url',
            ])
            ->get();

        return $products;
    }

    public  function bank_data_product_main_en($slug, bankRepo $bankRepo)
    {
        $products = $bankRepo->getFindSlug($slug)
            ->products()
            ->where('is_default', 0)
            ->select([
                'title_en',
                'slug_en',
                'summary_en',
                'content_en',
                'price_en',
                'multi_image_en',
                'video_url_en',
            ])
            ->get();
        return $products;
    }
}
