<?php

namespace App\Models\Panel;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videolanding extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'video',
        'content',
        'title_en',
        'slug_en',
        'video_en',
        'content_en',
        'user_id',
        'duration',
        'duration_en',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['slug_en', 'slug']
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $appends = ['video_persian', 'video_english']; // نام صحیح برای متغیرها

    public function getvideoPersianAttribute()
    {
        return asset('files/video/' . $this->video);
    }

    public function getvideoEnglishAttribute()
    {
        return asset('files/video/en/' . $this->video_en);
    }
}
