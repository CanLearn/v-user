<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Panel\Mainlanding;
use App\Repository\main\mainRepo;
use App\Services\File;
use Illuminate\Http\Request;

class MainlandingController extends Controller
{
    public function __construct(public mainRepo $repo){}

    public function index()
    {
        return $mains = $this->repo->index();
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image' , 'mimes:jpeg,png,jpg,gif,svg'],
            'content_en' => ['required', 'string'],
            'title' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'sub_title' => ['required', 'string'],
            'sub_title_en' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);
        $image = $request->image ? File::image_en_main($request->image) : null ;
        $this->repo->store($request , $image);
        return response()->json(["message" => "success main create" , "status" => "success"] ,200) ;
    }


    public function show( $mainlanding)
    {
        return $mainlanding = $this->repo->getFindId($mainlanding);
    }


    public function update(Request $request,  $mainlanding)
    {
        $request->validate([
            'image' => ['required', 'image' , 'mimes:jpeg,png,jpg,gif,svg'],
            'content_en' => ['required', 'string'],
            'title' => ['required', 'string'],
            'title_en' => ['required', 'string'],
            'sub_title' => ['required', 'string'],
            'sub_title_en' => ['required', 'string'],
            'content' => ['required', 'string'],
        ]);
        $image = $request->image ? File::image_en_main($request->image) : null ;
        $this->repo->update($request , $mainlanding , $image);
        return response()->json(["message" => "success main updated" , "status" => "success"] ,200) ;
    }


    public function destroy( $mainlanding)
    {
        $this->repo->delete($mainlanding);
        return response()->json(["message" => "success main updated" , "status" => "success"] ,200) ;
    }
}
