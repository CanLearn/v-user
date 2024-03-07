<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFileSizeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $maxFileSize = 4000 * 1024 * 1024;
//        dd($maxFileSize);// 400MB
        if ($request->file('video')->getSize() > $maxFileSize) {

            return response()->json(['error' => 'حجم فایل بیشتر از حد مجاز است'], 400);
        }

        return $next($request);
    }
}
//if ($request->filesize(file('your_file_input')) > $maxFileSize) {
//    return response()->json(['error' => 'حجم فایل بیشتر از حد مجاز است'], 400);
//}
