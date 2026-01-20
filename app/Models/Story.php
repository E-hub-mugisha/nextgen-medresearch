<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    protected $fillable = [
        'name',
        'title',
        'story',
        'category_id',
        'image',
        'video_url',
        'status',
        'featured',
    ];

    // Optional but recommended
    protected $casts = [
        'featured' => 'boolean',
    ];

    // Relationships (if needed)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
