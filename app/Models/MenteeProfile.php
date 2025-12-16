<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenteeProfile extends Model
{
    protected $fillable = [
        'user_id',
        'research_goals',
        'education_level',
    ];
}
