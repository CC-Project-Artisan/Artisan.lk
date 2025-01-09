<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExhibitionStall extends Model
{
    protected $fillable = [
        'exhibition_id',
        'name',
        'size',
        'price',
        'type',
        'type_price',
        'requirements',
    ];

    public function exhibition()
    {
        return $this->belongsTo(Exhibition::class);
    }
}
