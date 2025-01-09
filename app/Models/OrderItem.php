<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;
    // Define fillable fields
    protected $fillable = [
        'order_id', 
        'product_id', 
        'quantity', 
        'price'
    ];

    // Define relationships with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Define the relationship with the Order model
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
