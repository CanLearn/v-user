<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Services\File;
use Illuminate\Support\Facades\Storage;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function store(StoreTestRequest $request)
    {
        $receiverVideo = new FileReceiver("video", $request, HandlerFactory::classFromRequest($request));
        if ($receiverVideo->isUploaded() === false) {
            throw new UploadMissingFileException();
        }
        $fileReceived = $receiverVideo->receive();
        if($fileReceived->isFinished())
        {
            $file = $fileReceived->getFile();
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension , '' ,$file->getClientOriginalName());
            $fileName = '_' . md5(time()) . '.' . $extension;
            $disk = Storage::disk(config('filesystems.default'));
            $path = $disk->putFileAs('video' , $file , $fileName);
            unlink($file->getPathname());
            $handler = $fileReceived->handler();
            return [
                'done' => $handler->getPercentageDone()
            ];
        }
        return response()->json(['ok'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //
    }
}
