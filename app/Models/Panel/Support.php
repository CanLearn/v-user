<?php

namespace App\Models\Panel;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'link',
        'content',
        'user_id'
    ];

    protected $hidden = [
       'created_at',
       'pivot',
       'updated_at',
       'user_id'
     ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'support_products');
    }
}
