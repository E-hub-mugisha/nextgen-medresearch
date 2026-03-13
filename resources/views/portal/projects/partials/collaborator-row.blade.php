<div class="collab-member-row">

    <div class="person-avatar {{ $collaborator->role === 'mentor' ? 'blue' : '' }}">
        {{ strtoupper(substr($collaborator->name, 0, 2)) }}
    </div>

    <div class="person-info">
        <span class="person-name">{{ $collaborator->name }}</span>
        <span class="person-role d-flex align-items-center gap-2">
            <span class="role-pill {{ $collaborator->role }}">
                {{ ucfirst($collaborator->role) }}
            </span>
            @if($collaborator->role === 'mentor' && $collaborator->mentorProfile)
                · {{ $collaborator->mentorProfile->expertise }}
            @elseif($collaborator->role === 'mentee' && $collaborator->menteeProfile)
                · {{ $collaborator->menteeProfile->education_level }}
            @endif
        </span>
    </div>

    <div class="d-flex align-items-center gap-2 ms-auto">
        <a href="{{ route('portal.users.show', $collaborator) }}"
           class="btn-connect">
            Profile
        </a>

        @if(auth()->id() === $project->owner_id)
            <form method="POST"
                  action="{{ route('portal.collaborators.remove', ['project' => $project, 'user' => $collaborator]) }}"
                  onsubmit="return confirm('Remove {{ $collaborator->name }} from this project?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-reject" title="Remove">
                    <i class="bi bi-person-dash"></i>
                </button>
            </form>
        @endif

        {{-- Collaborator can leave --}}
        @if(auth()->id() === $collaborator->id)
            <form method="POST"
                  action="{{ route('portal.collaborators.remove', ['project' => $project, 'user' => $collaborator]) }}"
                  onsubmit="return confirm('Leave this project?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn btn-secondary btn-sm">
                    <i class="bi bi-box-arrow-left me-1"></i>Leave
                </button>
            </form>
        @endif
    </div>

</div>