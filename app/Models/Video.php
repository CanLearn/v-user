<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [ 'videotable_type' , 'videotable_id' , 'url' , 'url_en'];

    public function videotable()
    {
        return $this->morphTo();
    }
}
