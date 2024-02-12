<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footerlanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'phone',
        'number_whatsapp',
        'telegram',
        'yahoo',
        'gmail',
        'whatsapp',
        'address_en',
        'phone_en',
        'number_whatsapp_en',
        'telegram_en',
        'yahoo_en',
        'gmail_en',
        'whatsapp_en',
    ];
}
