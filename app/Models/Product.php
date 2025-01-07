<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'productName',
        'productDescription',
        'productPrice',
        'productCategory',
        'productQuantity',
        'productImages',
        'weight',
        'dimensions',
        'category_id', // Make sure to include category_id here
    ];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
