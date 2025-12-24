<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'main_category_id',
        'name',
        'description',
        'status',
    ];

    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class);
    }
}
