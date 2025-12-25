<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectCollaborator extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'user_id',
        'role'
    ];

    // Collaborator belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Collaborator belongs to a project
    public function project()
    {
        return $this->belongsTo(ResearchProject::class, 'project_id');
    }
}
