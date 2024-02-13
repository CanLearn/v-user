<?php

namespace App\Repository\footer;

use App\Models\Panel\Footerlanding;

class footerRepo
{
    public function index()
    {
        return Footerlanding::query()->orderByDesc('created_at')->first();
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
            'address_en' => $data['address_en'],
            'phone_en' => $data['phone_en'],
            'number_whatsapp_en' => $data['number_whatsapp_en'],
            'telegram_en' => $data['telegram_en'],
            'yahoo_en' => $data['yahoo_en'],
            'gmail_en' => $data['gmail_en'],
            'whatsapp_en' => $data['whatsapp_en'],
        ]);
    }

    public function getFindId($id)
    {
        return Footerlanding::query()->findOrFail($id);
    }

    public function update($data, $id)
    {
        // dd($data->all() , $id);
        $footer = $this->getFindId($id);
        return Footerlanding::query()->where('id', $id)->update([
            'address' => $data['address'] ?? $footer->address,
            'phone' => $data['phone'] ?? $footer->phone,
            'number_whatsapp' => $data['number_whatsapp'] ?? $footer->number_whatsapp,
            'telegram' => $data['telegram'] ?? $footer->telegram,
            'yahoo' => $data['yahoo'] ?? $footer->yahoo,
            'gmail' => $data['gmail'] ?? $footer->gmail,
            'whatsapp' => $data['whatsapp'] ?? $footer->whatsapp,
            'address_en' => $data['address_en'] ?? $footer->address_en,
            'phone_en' => $data['phone_en'] ?? $footer->phone_en,
            'number_whatsapp_en' => $data['number_whatsapp_en'] ?? $footer->number_whatsapp_en,
            'telegram_en' => $data['telegram_en'] ?? $footer->telegram_en,
            'yahoo_en' => $data['yahoo_en'] ?? $footer->yahoo_en,
            'gmail_en' => $data['gmail_en'] ?? $footer->gmail_en,
            'whatsapp_en' => $data['whatsapp_en'] ?? $footer->whatsapp_en,
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
        ])->orderByDesc('created_at')->first();
    }

    public function getFindEn()
    {
        
        return Footerlanding::query()->select([
            'address_en',
            'phone_en',
            'number_whatsapp_en',
            'telegram_en',
            'yahoo_en',
            'gmail_en',
            'whatsapp_en',
        ])->orderByDesc('created_at')->first();
    }
}
