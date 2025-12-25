<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'mentee_id',
        'title',
        'description',
        'research_area',
        'status',
        'start_date',
        'end_date'
    ];

    // Project belongs to a mentee
    public function mentee()
    {
        return $this->belongsTo(User::class, 'mentee_id');
    }

    // Project has many milestones
    public function milestones()
    {
        return $this->hasMany(ResearchMilestone::class, 'project_id');
    }

    // Project has many collaborators (mentors or other users)
    public function collaborators()
    {
        return $this->hasMany(ProjectCollaborator::class, 'project_id');
    }
}
