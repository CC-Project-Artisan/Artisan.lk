<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VendorExhibitionRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'stall_id',
        'stall_type',
        'exhibitor_name',
        'exhibitor_email',
        'exhibitor_phone',
        'exhibition_address',
        'business_name',
        'business_category',
        'business_email',
        'business_phone',
        'requirements',
        'total_price',
        'payment_status',
    ];
}
