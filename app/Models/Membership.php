<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'type',
        'organization',
        'motivation',
        'status',
    ];
}
