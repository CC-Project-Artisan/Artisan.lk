<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_token',
        'product_id',
        'quantity',
        'price',
        'image',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}