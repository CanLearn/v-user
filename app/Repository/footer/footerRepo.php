<?php

namespace App\Repository\footer;

use App\Models\Panel\Footerlanding;

class footerRepo
{
    public function index()
    {
        return Footerlanding::query()->paginate();
    }

    public function create($data)
    {
        return Footerlanding::query()->create([
            'address' => $data['address'],
            'phone' => $data['phone'],
            'number_whatsapp' => $data['number_whatsapp'],
            'telegram' => $data['telegram'],
            'yahoo' => $data['yahoo'],
            'gmail' => $data['gmail'],
            'whatsapp' => $data['whatsapp'],
        ]);
    }

    public function getFindId($id)
    {
        return Footerlanding::query()->findOrFail($id);
    }

    public function update($data, $id)
    {
        $footer = $this->getFindId($id);
        return Footerlanding::query()->where('id', $id)->update([
            'address' => $data['address'] ?? $footer->address,
            'phone' => $data['phone'] ?? $footer->phone,
            'number_whatsapp' => $data['number_whatsapp'] ?? $footer->number_whatsapp,
            'telegram' => $data['telegram'] ?? $footer->telegram,
            'yahoo' => $data['yahoo'] ?? $footer->yahoo,
            'gmail' => $data['gmail'] ?? $footer->gmail,
            'whatsapp' => $data['whatsapp'] ?? $footer->whatsapp,
        ]);
    }

    public function delete($id)
    {
        return Footerlanding::query()->where('id', $id)->delete();
    }

    public function getAllLanding()
    {
        return Footerlanding::query()->get();
    }

    public function getFindFa()
    {
        return Footerlanding::query()->select([
            'address',
            'phone',
            'number_whatsapp',
            'telegram',
            'yahoo',
            'gmail',
            'whatsapp',
        ]);
    }

    public function getFindEn()
    {
        return Footerlanding::query()->select([
            'address',
            'phone',
            'number_whatsapp',
            'telegram',
            'yahoo',
            'gmail',
            'whatsapp',
        ]);
    }
}
