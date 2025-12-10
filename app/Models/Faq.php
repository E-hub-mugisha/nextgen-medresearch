<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question',
        'answer',
        'category',
        'featured',
        'status',
        'display_order'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
