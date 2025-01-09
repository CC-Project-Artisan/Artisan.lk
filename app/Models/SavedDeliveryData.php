<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavedDeliveryData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'country',
        'first_name',
        'last_name',
        'address',
        'apartment',
        'city',
        'postal_code',
        'phone',
    ];
}
