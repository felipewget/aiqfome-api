<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['store_api_id', 'title', 'price', 'image', 'review'];

    protected $casts = [
        'review' => 'array',
    ];

    public function favoritedByUsers()
    {
        return $this->belongsToMany(User::class, 'user_favorite_products');
    }
}
