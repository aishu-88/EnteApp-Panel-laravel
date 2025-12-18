<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'type', // 'service' or 'shop'
        'provider_name',
        'provider_id', // Foreign key to users table
        'icon',
        'status', // 'active', 'pending', 'inactive'
        'featured', // boolean
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    // Scope for active listings
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Relationship to User (provider)
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}