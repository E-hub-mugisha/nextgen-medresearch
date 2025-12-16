<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResearchInterest extends Model
{
    // ResearchInterest.php
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
