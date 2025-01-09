<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ExhibitionContact;
use App\Models\ExhibitionEmail;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exhibition_name',
        'exhibition_description',
        // 'date_option',
        // 'start_date',
        // 'end_date',
        'exhibition_date',
        'start_time',
        'end_time',
        'exhibition_location',
        'organization_name',
        // 'category_all',
        'category_name',
        'exhibitionBanner',
        'registration_start_date',
        'registration_end_date',
        'max_exhibitors',
        'vendor_entrance_fee',
        'regular_price',
        'student_price',
        'child_price',
        'social_media_links',
        'layout',

        'name',
        'description',
        'isActive',
        'status',
        'status_updated_at',
    ];

    protected $casts = [
        'social_media_links' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Contact numbers
    public function contacts()
    {
        return $this->hasMany(ExhibitionContact::class);
    }

    // Relationship with Emails
    public function emails()
    {
        return $this->hasMany(ExhibitionEmail::class);
    }

    // Relationship with Stalls
    public function stalls()
    {
        return $this->hasMany(ExhibitionStall::class);
    }
}
