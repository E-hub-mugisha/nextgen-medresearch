<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchSpace extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'target_area',
        'importance',
        'impact',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'research_users')
            ->withTimestamps();
    }
}
