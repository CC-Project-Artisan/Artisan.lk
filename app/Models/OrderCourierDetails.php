<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderCourierDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'courier_name',
        'courier_contact_number',
        'tracking_number',
        'delivery_date',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
