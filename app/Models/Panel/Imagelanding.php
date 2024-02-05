<?php

namespace App\Models\Panel;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagelanding extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'content',
        'title_en',
        'slug_en',
        'image_en',
        'content_en',
        'user_id',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['slug_en', 'slug']
            ]
        ];
    }

    // protected $appends = [ 'image_persion' , 'image_enlish' ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function getImageEnlisheAttribute()
    // {
    //     return asset('images/image_en_landing/' . $this->image_en) ;
    // }

    // public function getImagePersionAttribute()
    // {
    //     return asset('images/image_landing/' . $this->image);
    // }

    protected $appends = ['image_persion', 'image_english']; // نام صحیح برای متغیرها

    public function getImageEnglishAttribute()
    {
        return asset('images/image_en_landing/' . $this->image_en);
    }

    public function getImagePersionAttribute()
    {
        return asset('images/image_landing/' . $this->image);
    }
}
