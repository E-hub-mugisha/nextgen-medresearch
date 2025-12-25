<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMilestone extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'due_date'
    ];

    // Milestone belongs to a project
    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'project_id');
    }

    // Milestone has many comments
    public function comments()
    {
        return $this->hasMany(MilestoneComment::class, 'milestone_id');
    }
}
