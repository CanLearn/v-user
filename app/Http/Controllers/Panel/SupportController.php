<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupportRequest;
use App\Http\Requests\UpdateSupportRequest;
use App\Repository\supportRepo\supportRepo;

class SupportController extends Controller
{
    public function __construct(public supportRepo $supportRepo){}

    public function index()
    {
        return $support = $this->supportRepo->index();
    }

    public function store(StoreSupportRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->supportRepo->create($request);
        return response()->json(["message" => "پشتبانی ساخته شد "], 200);
    }

    public function show($support)
    {
        return $this->supportRepo->getById($support);
    }

    public function update(UpdateSupportRequest $request, $support): \Illuminate\Http\JsonResponse
    {
        $this->supportRepo->update($request , $support);
        return response()->json(["message" => "پشتبانی ویرایش  شد "], 200);
    }
    public function destroy($support): \Illuminate\Http\JsonResponse
    {
        $this->supportRepo->delete($support);
        return response()->json(["message" => "پشتبانی حذف  شد "], 200);
    }
}
