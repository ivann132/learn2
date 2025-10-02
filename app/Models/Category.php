<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function news()
    {
        return $this->hasMany(News::class, 'category_id', 'id');
    }

    public function scopeWithPublishedNews($query)
    {
        return $query->whereHas('news', function($q) {
            $q->where('status', 'published');
        });
    }
}
