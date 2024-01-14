<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Panel\Category;
use App\Repository\category\categoryRepo;

class CategoryController extends Controller
{
    public function __construct(public categoryRepo $categoryRepo)
    {
    }

    public function index()
    {
        $categories = $this->categoryRepo->index();
        return response()->json(['data' => $categories], 200);
    }


    public function store(StoreCategoryRequest $request)
    {
        $this->categoryRepo->store($request);
        return response()->json([' دسته بندی ساخته شد'], 200);
    }


    public function show($category)
    {
        return $category = $this->categoryRepo->getTitleId($category);
    }

    public function update(UpdateCategoryRequest $request, $category)
    {
        $this->categoryRepo->delete($request , $category);
        return response()->json(['دسته بندی ویرایش  شد'], 200);
    }


    public function destroy($category)
    {
        $this->categoryRepo->delete($category);
        return response()->json(['دسته بندی حذف شد '], 200);
    }
}
