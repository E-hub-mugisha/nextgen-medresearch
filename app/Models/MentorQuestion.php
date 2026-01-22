<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MentorQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'question',
        'status',
        'featured',
        'mentor_category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(MentorAnswer::class);
    }
    public function category()
    {
        return $this->belongsTo(MentorCategory::class, 'mentor_category_id');
    }
}
