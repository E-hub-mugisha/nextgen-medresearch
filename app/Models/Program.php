<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'description',
        'icon',
        'status',
        'featured',
        'display_order',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
