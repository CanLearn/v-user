<?php

namespace App\Models\Panel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'slug_en',
        'summary',
        'summary_en',
        'content',
        'content_en',
        'multi_image',
        'multi_image_en',
        'video_url',
        'video_url_en',
        'price',
        'price_en',
        'status_price',
        'user_id'
    ];
    const STATUS_PRICE_DISABLE = 'disable';
    const STATUS_PRICE_ANSIBLE = 'ansible';

    static $status_price = [
        self::STATUS_PRICE_DISABLE,
        self::STATUS_PRICE_ANSIBLE
    ];

}
