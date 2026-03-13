@extends('layouts.portal')
@section('title', 'Edit Profile')

@section('content')

<div class="page-header-row">
    <div>
        <a href="{{ route('portal.profile.show') }}" class="breadcrumb-link">
            <i class="bi bi-arrow-left me-1"></i> Back to Profile
        </a>
        <h1 class="page-title mt-1">Edit Profile</h1>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success mb-4">
        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
    </div>
@endif

<div class="row justify-content-center">
<div class="col-lg-8">

<form method="POST"
      action="{{ route('portal.profile.update') }}"
      enctype="multipart/form-data">
@csrf @method('PATCH')

    {{-- ── ACCOUNT ─────────────────────────────────────── --}}
    <div class="panel mb-4">
        <div class="panel-header">
            <span class="panel-title">
                <i class="bi bi-person me-2"></i>Account
            </span>
        </div>
        <div class="auth-section">
            <div class="row g-3">

                {{-- Profile Photo --}}
                <div class="col-12">
                    <label class="form-label">Profile Photo</label>
                    <div class="profile-photo-upload">
                        <div class="profile-photo-preview" id="photoPreview">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                     id="previewImg">
                            @else
                                <div class="photo-initials" id="photoInitials">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <input type="file"
                                   name="profile_photo"
                                   id="photoInput"
                                   class="d-none"
                                   accept="image/*">
                            <button type="button"
                                    class="btn btn-secondary btn-sm"
                                    onclick="document.getElementById('photoInput').click()">
                                <i class="bi bi-upload me-1"></i> Upload Photo
                            </button>
                            <p class="text-muted mt-1 mb-0" style="font-size:.75rem;">
                                JPG, PNG or WebP · max 2MB
                            </p>
                        </div>
                    </div>
                    @error('profile_photo')
                        <span class="field-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name', auth()->user()->name) }}" required>
                    @error('name') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', auth()->user()->email) }}" required>
                    @error('email') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">New Password</label>
                    <div class="input-group">
                        <input type="password" name="password"
                               class="form-control password-field"
                               placeholder="Leave blank to keep current">
                        <button type="button"
                                class="btn btn-outline-secondary toggle-password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                    @error('password') <span class="field-error">{{ $message }}</span> @enderror
                </div>

                <div class="col-md-6">
                    <label class="form-label">Confirm New Password</label>
                    <div class="input-group">
                        <input type="password" name="password_confirmation"
                               class="form-control password-field"
                               placeholder="Repeat new password">
                        <button type="button"
                                class="btn btn-outline-secondary toggle-password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ── PROFILE INFO ─────────────────────────────────── --}}
    <div class="panel mb-4">
        <div class="panel-header">
            <span class="panel-title">
                <i class="bi bi-card-text me-2"></i>Profile Information
            </span>
            <span class="role-pill {{ auth()->user()->role }}">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </div>
        <div class="auth-section">
            @php $profile = auth()->user()->role === 'mentor'
                ? auth()->user()->mentorProfile
                : auth()->user()->menteeProfile;
            @endphp

            <div class="row g-3">

                <div class="col-12">
                    <label class="form-label">Short Bio</label>
                    <textarea name="bio" rows="4" class="form-control"
                              placeholder="Tell collaborators about yourself...">{{ old('bio', $profile?->bio) }}</textarea>
                </div>

                @if(auth()->user()->role === 'mentor')

                    <div class="col-md-6">
                        <label class="form-label">Academic Title</label>
                        <input type="text" name="academic_title" class="form-control"
                               value="{{ old('academic_title', $profile?->academic_title) }}"
                               placeholder="e.g. Dr., Prof., Assoc. Prof.">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Expertise</label>
                        <input type="text" name="expertise" class="form-control"
                               value="{{ old('expertise', $profile?->expertise) }}"
                               placeholder="e.g. Machine Learning, Genomics">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Organization</label>
                        <input type="text" name="organization" class="form-control"
                               value="{{ old('organization', $profile?->organization) }}"
                               placeholder="University or institution">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control"
                               value="{{ old('country', $profile?->country) }}"
                               placeholder="e.g. Philippines">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Years of Experience</label>
                        <input type="number" name="experience_years"
                               class="form-control" min="0"
                               value="{{ old('experience_years', $profile?->experience_years) }}">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Max Mentees</label>
                        <input type="number" name="max_mentees"
                               class="form-control" min="1"
                               value="{{ old('max_mentees', $profile?->max_mentees) }}">
                    </div>

                    <div class="col-md-4 d-flex align-items-end pb-1">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox"
                                   name="available" id="chkAvailable" value="1"
                                   {{ old('available', $profile?->available) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="chkAvailable">
                                Available for mentoring
                            </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" class="form-control"
                               value="{{ old('linkedin_url', $profile?->linkedin_url) }}"
                               placeholder="https://linkedin.com/in/...">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Google Scholar URL</label>
                        <input type="url" name="google_scholar_url" class="form-control"
                               value="{{ old('google_scholar_url', $profile?->google_scholar_url) }}"
                               placeholder="https://scholar.google.com/...">
                    </div>

                @else

                    <div class="col-md-6">
                        <label class="form-label">Education Level</label>
                        <select name="education_level" class="form-select">
                            <option value="">Select level</option>
                            @foreach(['Undergraduate','Graduate (Masters)','PhD / Doctorate','Postdoctoral','Faculty / Professor'] as $level)
                                <option value="{{ $level }}"
                                    {{ old('education_level', $profile?->education_level) === $level ? 'selected' : '' }}>
                                    {{ $level }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Institution</label>
                        <input type="text" name="institution" class="form-control"
                               value="{{ old('institution', $profile?->institution) }}"
                               placeholder="University or school">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Country</label>
                        <input type="text" name="country" class="form-control"
                               value="{{ old('country', $profile?->country) }}"
                               placeholder="e.g. Philippines">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Availability</label>
                        <select name="availability" class="form-select">
                            <option value="">Select availability</option>
                            @foreach(['Full-time','Part-time','Weekends only','Flexible'] as $opt)
                                <option value="{{ $opt }}"
                                    {{ old('availability', $profile?->availability) === $opt ? 'selected' : '' }}>
                                    {{ $opt }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Research Goal</label>
                        <input type="text" name="research_goal" class="form-control"
                               value="{{ old('research_goal', $profile?->research_goal) }}"
                               placeholder="What are you aiming to achieve?">
                    </div>

                @endif

            </div>
        </div>
    </div>

    {{-- ── RESEARCH INTERESTS ───────────────────────────── --}}
    <div class="panel mb-4">
        <div class="panel-header">
            <span class="panel-title">
                <i class="bi bi-flask me-2"></i>Research Interests
            </span>
        </div>
        <div class="auth-section">
            <div class="row g-2">
                @foreach($interests as $interest)
                <div class="col-md-4 col-6">
                    <label class="interest-checkbox">
                        <input type="checkbox"
                               name="interests[]"
                               value="{{ $interest->id }}"
                               {{ auth()->user()->researchInterests->contains($interest->id) ? 'checked' : '' }}>
                        <span>{{ $interest->name }}</span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ── FOOTER ──────────────────────────────────────── --}}
    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('portal.profile.show') }}"
           class="btn btn-secondary">
            Cancel
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-check-lg me-1"></i> Save Changes
        </button>
    </div>

</form>

</div>
</div>

@push('scripts')
<script>
// Preview photo
document.getElementById('photoInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('photoPreview');
        preview.innerHTML = `<img src="${e.target.result}" id="previewImg">`;
    };
    reader.readAsDataURL(file);
});

// Toggle password
document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.addEventListener('click', function () {
        const inp  = this.closest('.input-group').querySelector('.password-field');
        const icon = this.querySelector('i');
        inp.type = inp.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    });
});
</script>
@endpush

@endsection