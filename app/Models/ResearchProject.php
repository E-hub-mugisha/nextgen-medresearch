<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'title',
        'description',
        'research_area',
        'status',
        'start_date',
        'end_date'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Project has many milestones
    public function milestones()
    {
        return $this->hasMany(ResearchMilestone::class, 'project_id');
    }

    // Project has many collaborators (mentors or other users)
    public function collaborators()
    {
        return $this->belongsToMany(User::class, 'project_collaborators')->withPivot('role', 'status')->withTimestamps();
    }
}
