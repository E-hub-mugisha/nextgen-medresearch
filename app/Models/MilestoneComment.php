<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilestoneComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'milestone_id',
        'user_id',
        'comment'
    ];

    // Comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Comment belongs to a milestone
    public function milestone()
    {
        return $this->belongsTo(ResearchMilestone::class, 'milestone_id');
    }
}
