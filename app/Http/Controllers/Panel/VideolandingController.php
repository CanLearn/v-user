<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Repository\Video\mainRepo;
use App\Repository\Video\videoRepo;
use App\Services\File;
use FFMpeg\FFProbe;
use Illuminate\Http\Request;

class VideolandingController extends Controller
{

    public function __construct(public videoRepo $videoRepo)
    {
    }

    public function index()
    {
        return $video = $this->videoRepo->index();
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
            'video_en' => ['nullable',  'mimes:mp4,mov,ogg,qt'],
            'title' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],

        ]);
        $duration = $this->getVideoDuration($request->file('video'));
        $duration_en = $this->getVideoDurationEn($request->file('video_en'));

        $video = $request->video ? File::video_landing($request->file('video')) : null;
        $video_en = $request->video_en ? File::video_en_landing($request->file('video_en')) : null;


        $this->videoRepo->store($request->only('title', 'content', 'title_en', 'content_en',), $video, $video_en, $duration, $duration_en);
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }


    public function show($videolanding)
    {
        return $videolanding = $this->videoRepo->getFindId($videolanding);
    }


    public function update(Request $request, $videolanding)
    {
        $request->validate([
            'video' => ['nullable', 'mimes:mp4,mov,ogg,qt'],
            'video_en' => ['nullable',  'mimes:mp4,mov,ogg,qt'],
            'title' => ['nullable', 'string'],
            'title_en' => ['nullable', 'string'],
            'content_en' => ['nullable', 'string'],
            'content' => ['nullable', 'string'],

        ]);
        $videolanding = $this->videoRepo->getFindId($videolanding);
        $video = $request->video ? File::video_landing($request->file('video')) : null;
        $video_en = $request->video_en ? File::video_en_landing($request->file('video_en')) : null;
        $this->videoRepo->update($request->only('title', 'content', 'title_en', 'content_en'), $videolanding, $video, $video_en);
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }


    public function destroy($videolanding)
    {
        $this->videoRepo->delete($videolanding);
        return response()->json(['message' => "success video ", 'status' => 'success'], 200);
    }

    public function getVideoDuration($video)
    {
        $ffprobe = FFProbe::create([
            'ffmpeg.binaries' => '/path/to/ffmpeg', // Path to ffmpeg binary
            'ffprobe.binaries' => '/path/to/ffprobe', // Path to ffprobe binary
        ]);
        dd($ffprobe);
        // $duration = $ffmpeg->open($video->getPathname())
        //     ->getStreams()
        //     ->first()
        //     ->get('duration');
        // dd($duration);
        // // تبدیل مدت زمان به ساعت و دقیقه
        // $hours = floor($duration / 3600);
        // $minutes = floor(($duration / 60) % 60);
        // return ['hours' => $hours, 'minutes' => $minutes];
    }

    // public function getVideoDurationEn($video)
    // {
    //     $ffmpeg = FFMpeg::create();

    //     $duration = $ffmpeg->open($video->getPathname())
    //         ->getStreams()
    //         ->first()
    //         ->get('duration');

    //     // تبدیل مدت زمان به ساعت و دقیقه
    //     $hours = floor($duration / 3600);
    //     $minutes = floor(($duration / 60) % 60);
    //     return ['hours' => $hours, 'minutes' => $minutes];
    // }
}
