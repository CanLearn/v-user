<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Panel\Product;
use App\Repository\products\productRepo;
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

        foreach ($request->file('multi_image') as $image) {
            $imageName = Str::random(15) . ' . ' . $image->getClientOriginalName();
            $image->move(public_path('images/products/fa/') , $imageName);
            $fileNames[] = $imageName;
        }
        foreach ($request->file('multi_image_en') as $imageEn) {
            $imageName = Str::random(15) . ' . ' . $imageEn->getClientOriginalName();
            $imageEn->move(public_path('images/products/en/') , $imageName);
            $fileNames_en[] = $imageName;
        }
        $video_url = $request->video_url ? $request->video_url : null ;
        $video_url = $request->video_url_en ? $request->video_url_en : null ;
        if($video_url){

        }
        $multi_image = $fileNames;
        $multi_image_en = $fileNames_en;

        $video_url = 'asaSA';
        $video_url_en = 'asaSA';
        $this->productRepo->create($request, $multi_image, $multi_image_en, $video_url, $video_url_en);
        return response()->json(['ok'], 200);
    }

    public function show($product)
    {
        return $this->productRepo->getFindId($product);
    }

    public function update(UpdateProductRequest $request, $product)
    {
        $this->productRepo->update($request, $product);
        return response()->json(['ok'], 200);
    }

    public function destroy($product)
    {
        $this->productRepo->delete($product);
        return response()->json(['ok'], 200);
    }
}
