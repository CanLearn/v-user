<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Panel\Imagelanding;
use App\Repository\images\imageRepo;
use App\Services\File;
use Illuminate\Http\Request;

class ImagelandingController extends Controller
{
    public function __construct(public imageRepo $imageRepo)
    {
    }

    public function index()
    {
        return $images = $this->imageRepo->index();
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => ['nullable', 'image' , 'mimes:jpeg,png,jpg,gif,svg'],
            'image_en' => ['nullable', 'image' , 'mimes:jpeg,png,jpg,gif,svg'],
            'content_en' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'content' => ['nullable', 'string'],
        ]);
        $image = $request->file('image') ? File::image_landing($request->image) : null;
        $image_en = $request->file('image_en') ? File::image_en_landing($request->image_en) : null;
        $this->imageRepo->store($request->only('title', 'content', 'title_en', 'content_en'), $image, $image_en);
        return response()->json(['message' => "success created images ", 'status' => 'success'], 200);
    }

    public function show($imagelanding)
    {
        return $imagelanding = $this->imageRepo->getFindId($imagelanding);
    }

    public function update(Request $request, $imagelanding)
    {
        $request->validate([
            'image' => ['nullable',  'mimes:jpeg,png,jpg,gif,svg'],
            'image_en' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg'],
            'content_en' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'content' => ['nullable', 'string'],
        ]);
        $image = $request->file('image') ? File::image_landing($request->image) : null;
        $image_en = $request->file('image_en') ? File::image_en_landing($request->image_en) : null;
        $this->imageRepo->update($request->only('title', 'content', 'title_en', 'content_en'), $imagelanding, $image, $image_en);
        return response()->json(['message' => "success updated images ", 'status' => 'success'], 200);
    }

    public function destroy($imagelanding)
    {
        $this->imageRepo->delete($imagelanding);
        return response()->json(['message' => "success deleted images ", 'status' => 'success'], 200);
    }
}
