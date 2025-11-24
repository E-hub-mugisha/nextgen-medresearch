<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'category_id',
        'summary',
        'description',
        'banner',
        'project_link',
        'status',
        'featured',
        'display_order',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
