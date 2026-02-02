<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laptop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'cpu',
        'ram',
        'storage',
        'gpu',
        'brand',
        'description',
        'image',
        'status',
        'category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_laptop');
    }

    public function getPriceLabelAttribute(): string
    {
        $price = $this->price ?? 0;

        return number_format((float) $price, 0, ',', '.') . 'đ';
    }
}
