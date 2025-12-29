<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenteeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'research_goals',
        'education_level',
        'bio',            // bio/about section
        'location',
        'image'
    ];

    // Relationship to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
