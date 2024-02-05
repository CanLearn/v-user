<?php

namespace App\Models\Panel;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , Sluggable , SoftDeletes;

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
        'user_id' ,
    ];
    protected $hidden = [
        'multi_image_en' ,
        'multi_image' ,
        'video_url' ,
        'video_url_en' ,
//        'status_price' ,
    ];
        public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'slug']
            ]
        ];
    }
    protected $casts = [
        'multi_image' => 'json',
        'multi_image_en'=> 'json',
        'video_url'=> 'json',
        'video_url_en'=> 'json',
    ];
    const STATUS_PRICE_DISABLE = 'disable';
    const STATUS_PRICE_ANSIBLE = 'enable';

    static $status_price = [
        self::STATUS_PRICE_DISABLE,
        self::STATUS_PRICE_ANSIBLE
    ];
    protected $appends = [ 'multi_image_fa' , 'image_en' , 'video_fa' , 'video_en' ];

    public function categories()
    {
        return $this->belongsToMany(Category::class , 'category_product');
    }
    public function supports():BelongsToMany
    {
        return $this->belongsToMany(Support::class , 'support_products');
    }

    public function getMultiImageFaAttribute()
    {

        return collect($this->multi_image)->map(function ($imageName) {
            return asset('images/products/fa/' . $imageName);
        })->toArray();
    }

    public function getImageEnAttribute()
    {
        return collect($this->multi_image_en)->map(function ($imageName) {
            return asset('images/products/en/' . $imageName);
        })->toArray();
    }

    public function getVideoFaAttribute()
    {
        return collect($this->video_url)->map(function ($imageName) {
            return asset('files/products/fa/' . $imageName);
        })->toArray();
    }

    public function getVideoEnAttribute()
    {
        return collect($this->video_url_en)->map(function ($imageName) {
            return asset('files/products/en/' . $imageName);
        })->toArray();
    }
}
