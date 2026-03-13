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
    // Check if this mentor has been requested by a given mentee
    public function requestedBy($menteeId)
    {
        return $this->requestedByMentees()->where('mentee_id', $menteeId)->exists();
    }

    // Reverse relation: mentees who requested this mentor
    public function requestedByMentees()
    {
        return $this->belongsToMany(User::class, 'mentor_requests', 'mentor_id', 'mentee_id')
            ->withPivot('status')
            ->withTimestamps();
    }
    // For mentors
    public function reviews()
    {
        return $this->hasMany(MentorReview::class, 'mentor_id');
    }

    // For mentees
    public function givenReviews()
    {
        return $this->hasMany(MentorReview::class, 'mentee_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    /**
     * All messages (sent + received)
     */
    public function messages()
    {
        return Message::where(function ($q) {
            $q->where('sender_id', $this->id)
                ->orWhere('receiver_id', $this->id);
        });
    }

    public function researchSpaces()
    {
        return $this->belongsToMany(ResearchSpace::class, 'research_users')
            ->withTimestamps();
    }

    public function researchInterests()
    {
        return $this->belongsToMany(
            ResearchInterest::class,
            'research_interest_user' // pivot table
        );
    }

    public function projects()
    {
        return $this->hasMany(ResearchProject::class, 'owner_id');
    }

    public function collaborations()
    {
        return $this->belongsToMany(ResearchProject::class, 'project_collaborators', 'user_id', 'project_id')
            ->withPivot('role', 'status')
            ->withTimestamps();
    }

    // In User.php

    public function mentorProfile()
    {
        return $this->hasOne(MentorProfile::class);
    }

    public function menteeProfile()
    {
        return $this->hasOne(MenteeProfile::class);
    }


    // Helper to get the right profile regardless of role
    public function profile()
    {
        return $this->role === 'mentor'
            ? $this->mentorProfile
            : $this->menteeProfile;
    }
}
