<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mainlanding extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'sub_title',
        'sub_title_en',
        'title_en',
        'image',
        'content',
        'content_en',
    ];

}
