<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'last_name',
        'address',
        'city',
        'phone',
        'total',
        'stripe_payment_id',
        'status',
        'order_status',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function courierDetail()
    {
        return $this->hasOne(OrderCourierDetails::class);
    }
}
