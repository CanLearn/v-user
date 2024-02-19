<?php

namespace App\Models\Panel;

use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankData extends Model
{
    use HasFactory , Sluggable;
    protected $fillable = [
        'title',
        'slug',
        'title_en',
        'slug_en',
        'parent_id',
        'user_id',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'slug']
            ]
        ];
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class , 'parent_id');
    }

    public function child(): HasMany
    {
        return $this->hasMany(self::class , 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class , 'bank_data_product');
    }


}
