<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_id',
        'category_id',
        'title',
        'slug',
        'description',
        'price',
        'file_path',
        'thumbnail',
        'sales_count',
        'is_published',
        'status',
    ];

    //  المنتج ينتمي إلى بائع
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    //  المنتج ينتمي إلى تصنيف
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //  المنتج لديه مشتريات
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    //  المنتج في قوائم الرغبات
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    //  المنتج لديه مراجعات
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
