<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'file_path',
        'status',
    ];

    // Optional (recommended)
    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
