<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'expertise',
        'organization',
        'country',
        'experience_years',
        'max_mentees',
        'available',
        'academic_title',
        'linkedin_url',
        'google_scholar_url',
        'profile_photo',
        'mentee_count'
    ];

    protected $casts = [
        'available' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
