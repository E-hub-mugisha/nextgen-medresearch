<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResearchInterest extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    // slug generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ResearchInterest.php
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
