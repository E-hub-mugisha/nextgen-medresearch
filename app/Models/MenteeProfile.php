<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenteeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'bio',
        'research_goal',
        'education_level',
        'institution',
        'country',
        'availability',
        'profile_photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function projects()
    {
        // Go through the user, not directly
        return $this->hasMany(ResearchProject::class, 'owner_id', 'user_id');
    }
}
