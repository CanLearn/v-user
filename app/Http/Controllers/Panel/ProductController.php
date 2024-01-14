<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Panel\Product;
use App\Repository\products\productRepo;

class ProductController extends Controller
{
    public function __construct(public productRepo $productRepo){}

    public function index()
    {
        $products = $this->productRepo->index();
        return response()->json(['date' , $products] , 200) ;
    }

    public function store(StoreProductRequest $request)
    {
        $this->productRepo->create($request);
        return response()->json(['ok'] , 200) ;
    }

    public function show( $product)
    {
        return $this->productRepo->getFindId($product);
    }

    public function update(UpdateProductRequest $request,  $product)
    {
        $this->productRepo->update($request , $product);
        return response()->json(['ok'] , 200) ;
    }

    public function destroy( $product)
    {
        $this->productRepo->delete($product);
        return response()->json(['ok'] , 200) ;
    }
}
