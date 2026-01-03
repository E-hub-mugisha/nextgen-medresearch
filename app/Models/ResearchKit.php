<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchKit extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'display_order',
        'file_path',
    ];

    protected $casts = [
        'display_order' => 'integer',
    ];
}
