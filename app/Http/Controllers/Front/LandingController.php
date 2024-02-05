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
    public function index(mainRepo $mainRepo, videoRepo $videoRepo, imageRepo $imageRepo, footerRepo $footerRepo , categoryRepo $categoryRepo)
    {
        $mainRepo = $mainRepo->getAllLanding();
        $videoRepo = $videoRepo->getAllLanding();
        $imageRepo = $imageRepo->getAllLanding();
        $footerRepo = $footerRepo->getAllLanding();
        $categoryRepo = $categoryRepo->getParentId() ;
        return [
           'mainRepo' =>  $mainRepo,
           'videoRepo' =>  $videoRepo,
           'imageRepo' =>   $imageRepo,
           'footerRepo' =>  $footerRepo ,
           'categoryRepo' => $categoryRepo
        ];
    }

    public function category_product($slug ,  categoryRepo $categoryRepo)
    {
        $category = $categoryRepo->getFindSlug($slug) ;
        // $category = Category::query()->where('slug_en' , $slug )->first() ;

        dd($category->products);
        return 'asas' ;
    }
}
