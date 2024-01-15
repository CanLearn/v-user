<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Panel\Product;
use App\Repository\products\productRepo;
use App\Services\File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function __construct(public productRepo $productRepo)
    {
    }

    public function index()
    {
        $products = $this->productRepo->index();
        return response()->json(['date', $products], 200);
    }

    public function store(Request $request)
    {

        $multi_image = $request->multi_image ? File::image($request->file('multi_image')) : null ;
        $multi_image_en = $request->multi_image_en ? File::image_en($request->file('multi_image_en')) : null ;
        $video_url = $request->video_url ? File::video_peo($request->file('video_url')) : null ;
        $video_url_en = $request->video_url_en ? File::video_peo_en($request->file('video_url_en')) : null ;
        $this->productRepo->create($request, $multi_image, $multi_image_en, $video_url, $video_url_en);
        return response()->json(['ok'], 200);
    }

    public function show($product)
    {
        return $this->productRepo->getFindId($product);
    }

    public function update(UpdateProductRequest $request, $product)
    {
        $multi_image = $request->multi_image ? File::image($request->file('multi_image')) : null ;
        $multi_image_en = $request->multi_image_en ? File::image_en($request->file('multi_image_en')) : null ;
        $video_url = $request->video_url ? File::video_peo($request->file('video_url')) : null ;
        $video_url_en = $request->video_url_en ? File::video_peo_en($request->file('video_url_en')) : null ;
        $this->productRepo->update($request, $product , $multi_image, $multi_image_en, $video_url, $video_url_en);
        return response()->json(['ok'], 200);
    }

    public function destroy($product)
    {
        $this->productRepo->delete($product);
        return response()->json(['ok'], 200);
    }
}
