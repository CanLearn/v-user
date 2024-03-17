<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Repository\Video\mainRepo;
use App\Repository\Video\videoRepo;
use App\Services\File;
use FFMpeg\FFProbe;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class VideolandingController extends Controller
{

    public function __construct(public videoRepo $videoRepo)
    {
    }

    public function index()
    {
        return $video = $this->videoRepo->index();

    }

    public function store_one(Request $request)
    {
        $request->validate([
            'title' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],

        ]);
        $store = $this->videoRepo->store_one($request->only('title', 'content', 'title_en', 'content_en',));
        return response()->json(['id' => $store->id], 200);
    }

    public function store_two(Request $request, $id)
    {
        $request->validate([
            'video_en' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
        ]);
        $store = $this->videoRepo->getFindId($id);
        $video_en = $request->video_en ? File::video_en_landing($request->file('video_en')) : null;
        $duration_en = $this->getVideoDurationEn($video_en);
        $this->videoRepo->store_two($id, $video_en, $duration_en);
        return response()->json(['id' => $store->id], 200);
    }

    public function store_three(Request $request, $id)
    {
        $request->validate([
            'video' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
        ]);
        $store = $this->videoRepo->getFindId($id);
        $video = $request->video ? File::video_landing($request->file('video')) : null;
        $duration = $this->getVideoDuration($video);
        $this->videoRepo->store_three($id, $video, $duration);
        return response()->json(['id' => $store->id], 200);
    }

    public function show($videolanding)
    {
        return $videolanding = $this->videoRepo->getFindId($videolanding);
    }

    public function update_one(Request $request, $videolanding)
    {
        $request->validate([
            'title' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],
        ]);
        $videolanding = $this->videoRepo->getFindId($videolanding);
        $this->videoRepo->update_one($request->only('title', 'content', 'title_en', 'content_en'), $videolanding);
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }

    public function update_two(Request $request, $videolanding)
    {
        $request->validate([
            'video_en' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
        ]);
        $videolanding = $this->videoRepo->getFindId($videolanding);
        $video_en = $request->video_en ? File::video_en_landing($request->file('video_en')) : null;
        $duration_en = $this->getVideoDurationEn($video_en);
        $this->videoRepo->update_two($videolanding, $video_en, $duration_en );
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }

    public function update_three(Request $request, $videolanding)
    {
        $request->validate([
            'video' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
        ]);
        $videolanding = $this->videoRepo->getFindId($videolanding);
        $video = $request->video ? File::video_landing($request->file('video')) : null;
        $duration = $this->getVideoDuration($video);
        $this->videoRepo->update_three($videolanding, $video, $duration );
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }


    public function destroy($videolanding)
    {
        $this->videoRepo->delete($videolanding);
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }

    public function getVideoDuration($video)
    {
        $getID3 = new getID3;
        $file = $getID3->analyze('files/video/' . $video);
        return $file['playtime_seconds'];
    }

    public function getVideoDurationEn($video)
    {
        $getID3 = new getID3;
        $file = $getID3->analyze('files/video/en/' . $video);
        return $file['playtime_seconds'];
    }
}

//public function store(Request $request)
//{
//    $request->validate([
//        'video' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
//        'video_en' => ['nullable',  'mimes:mp4,mov,ogg,qt'],
//        'title' => ['nullable', 'string'],
//        'title_en' => ['nullable', 'string'],
//        'content_en' => ['nullable', 'string'],
//        'content' => ['nullable', 'string'],
//
//    ]);
//
//    $video = $request->video ? File::video_landing($request->file('video')) : null;
//    $video_en = $request->video_en ? File::video_en_landing($request->file('video_en')) : null;
//
//    $duration = $this->getVideoDuration($video);
//
//    $duration_en = $this->getVideoDurationEn($video_en);
//
//    $this->videoRepo->store($request->only('title', 'content', 'title_en', 'content_en',), $video, $video_en, $duration, $duration_en);
//    return response()->json(['message' => "success video ", 'status' => 'success'], 200);
//}


// public function store(Request $request)
// {
//     $receiverVideo = new FileReceiver("video", $request, HandlerFactory::classFromRequest($request));
//     $receiverVideoEn = new FileReceiver("video_en", $request, HandlerFactory::classFromRequest($request));

//     if ($receiverVideo->isUploaded() === false) {
//         throw new UploadMissingFileException();
//     }
//     if ($receiverVideo->isUploaded() === false) {
//         throw new UploadMissingFileException();
//     }
//     $fileReceived = $receiverVideo->receive();
//     if($fileReceived->isFinished())
//     {
//         $file = $fileReceived->getFile();
//         $extension = $file->getClientOriginalExtension();
//         $fileName = str_replace('.' . $extension , '' ,$file->getClientOriginalName());
//         $fileName = '_' . md5(time()) . '.' . $extension;
//         $disk = Storage::disk(config('filesystems.default'));
//         $path = $disk->putFileAs('video' , $file , $fileName);
//         unlink($file->getPathname());

//         $handler = $fileReceived->handler();
//         return [
//             'done' => $handler->getPercentageDone()
//         ];
//     }

// }

//public function update(Request $request, $videolanding)
//{
//    $request->validate([
//        'video' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
//        'video_en' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
//        'title' => ['nullable', 'string'],
//        'title_en' => ['nullable', 'string'],
//        'content_en' => ['nullable', 'string'],
//        'content' => ['nullable', 'string'],
//    ]);
//    $video = $request->video ? File::video_landing($request->file('video')) : null;
//    $video_en = $request->video_en ? File::video_en_landing($request->file('video_en')) : null;
//    $videolanding = $this->videoRepo->getFindId($videolanding);
//    $duration = $this->getVideoDuration($video);
//    $duration_en = $this->getVideoDurationEn($video_en);
//    $this->videoRepo->update($request->only('title', 'content', 'title_en', 'content_en')
//        , $videolanding, $video, $video_en, $duration, $duration_en);
//    return response()->json(['message' => "success video ", 'status' => 'success'], 200);
//}
