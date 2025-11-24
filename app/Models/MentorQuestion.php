<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MentorQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'title', 'question', 'status', 'featured'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function answers() {
        return $this->hasMany(MentorAnswer::class);
    }
}
