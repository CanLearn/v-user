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
    ];
}
