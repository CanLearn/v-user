<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Panel\Footerlanding;
use App\Repository\footer\footerRepo;
use Illuminate\Http\Request;

class FooterlandingController extends Controller
{
    public function __construct(public footerRepo $footerRepo)
    {
    }

    public function index()
    {
        return $footer = $this->footerRepo->index();
    }


    public function store(Request $request)
    {
        $request->validate([
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'number_whatsapp' => ['nullable', 'string'],
            'telegram' => ['nullable', 'string'],
            'yahoo' => ['nullable', 'string'],
            'gmail' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string'],
        ]);
        $this->footerRepo->create($request);
        return response()->json(['message' => 'success created footer', 'status' => 'success'], 200);
    }


    public function show($footerlanding)
    {
        return $footerlanding = $this->footerRepo->getFindId($footerlanding);
    }


    public function update(Request $request, $footerlanding)
    {
        $request->validate([
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'number_whatsapp' => ['nullable', 'string'],
            'telegram' => ['nullable', 'string'],
            'yahoo' => ['nullable', 'string'],
            'gmail' => ['nullable', 'string'],
            'whatsapp' => ['nullable', 'string'],

        ]);
        $this->footerRepo->update($request , $footerlanding);
        return response()->json(['message' => 'success created footer', 'status' => 'success'], 200);

    }


    public function destroy($footerlanding)
    {
        $this->footerRepo->delete($footerlanding);
        return response()->json(['message' => 'success created footer', 'status' => 'success'], 200);

    }
}
