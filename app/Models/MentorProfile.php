<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'expertise',
        'country',
        'available',
        'organization',
        'experience_years',
        'max_mentees'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
