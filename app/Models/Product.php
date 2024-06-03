<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'name',
    //     'slug',
    //     'brand_id',
    //     'is_featured',
    //     'is_popular',
    //     'is_trending',
    //     'is_latest',
    //     'is_discounted',
    //     'description',
    //     'price',
    //     'image',
    //     'category_id',
    //     'user_id',
    //     'status',
    //     'quantity',

    // ];
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
