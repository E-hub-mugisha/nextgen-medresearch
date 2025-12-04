<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Research extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title', 'slug', 'category_id', 'summary', 'content',
        'document', 'featured_image', 'status', 'featured',
        'view_count', 'download_count', 'created_by', 'updated_by'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
