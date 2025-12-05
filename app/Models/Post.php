<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title','slug','category_id','excerpt','content','featured_image',
        'status','featured','publish_at','created_by','updated_by'
    ];

    // Add this line
    protected $dates = [
        'publish_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
