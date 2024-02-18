<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Panel\BankData;
use App\Http\Requests\StoreBankDataRequest;
use App\Http\Requests\UpdateBankDataRequest;
use App\Repository\bank\bankRepo;

class BankDataController extends Controller
{
    public function __construct(public bankRepo $bankRepo){ }

    public function index()
    {
        return $banks = $this->bankRepo->index() ;
    }


    public function store(StoreBankDataRequest $request)
    {
        $this->bankRepo->store($request);
        return response()->json(['  بانک اطلاعاتی ساخته شد'], 200);
    }


    public function show($bank)
    {
        return $bank = $this->bankRepo->getByShowId($bank);
    }

    public function update(UpdateBankDataRequest $request, $bank)
    {
        $this->bankRepo->update($request , $bank);
        return response()->json(['بانک اطلاعاتی ویرایش  شد'], 200);
    }


    public function destroy($bank)
    {
        $this->bankRepo->delete($bank);
        return response()->json(['بانک اطلاعاتی حذف شد '], 200);
    }

    public function parent(){
        $banks = $this->bankRepo->getParentId();
        return response()->json( $banks , 200);
    }
}
