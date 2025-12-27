<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider_id', 'shop_name', 'main_category_id', 'category_id', 'owner_name',
        'mobile', 'whatsapp', 'address', 'panchayath', 'google_map', 'opening_time',
        'closing_time', 'service_area', 'special_recommendation', 'description',
        'photo', 'gallery', 'plan_id', 'verification_status', 'is_active'
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_active' => 'boolean',
    ];

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
