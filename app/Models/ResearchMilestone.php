<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchMilestone extends Model
{
    protected $table = 'research_milestones';

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'status',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'project_id');
    }

    public function comments()
    {
        return $this->hasMany(MilestoneComment::class, 'milestone_id');
    }
}
