<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title,
            'slug' => $this->slug,
            'summary' => $this->summary,
            'content' => $this->content,
            'price' => $this->price,
            'multi_image' => $this->multi_image,
            'video_url' => $this->video_url,
            // اینجا می‌توانید داده‌های دیگر را نیز اضافه کنید
        ];
    }
}
