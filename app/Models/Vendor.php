<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'vendors';

    protected $fillable = [
        'provider_id',
        'shop_name',
        'category',
        'owner_name',
        'mobile',
        'whatsapp',
        'address',
        'panchayath',
        'google_map',
        'opening_time',
        'closing_time',
        'service_area',
        'description',
        'photo',
        'gallery',
        'plan_id',
        'verification_status',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];
}
