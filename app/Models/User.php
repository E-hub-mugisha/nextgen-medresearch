<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function mentorProfile()
    {
        return $this->hasOne(MentorProfile::class);
    }

    public function menteeProfile()
    {
        return $this->hasOne(MenteeProfile::class);
    }

    public function interests()
    {
        return $this->belongsToMany(ResearchInterest::class);
    }
    // Mentors the user has requested
    public function requestedMentors()
    {
        return $this->belongsToMany(User::class, 'mentor_requests', 'mentee_id', 'mentor_id')
            ->withPivot('status')
            ->withTimestamps();
    }

    // Mentorship requests received (for mentors)
    public function menteeRequests()
    {
        return $this->belongsToMany(User::class, 'mentor_requests', 'mentor_id', 'mentee_id')
            ->withPivot('status')
            ->withTimestamps();
    }
}
