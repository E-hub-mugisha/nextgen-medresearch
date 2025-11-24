<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorAnswer extends Model
{
    protected $fillable = [
        'mentor_question_id', 'mentor_id', 'answer'
    ];

    public function question() {
        return $this->belongsTo(MentorQuestion::class, 'mentor_question_id');
    }

    public function mentor() {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
