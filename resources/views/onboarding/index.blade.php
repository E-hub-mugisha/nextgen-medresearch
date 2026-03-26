@extends('layouts.join')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">

            <div class="card border-0 rounded-4 shadow-sm overflow-hidden">

                {{-- ── HEADER ─────────────────────────────────────────────── --}}
                <div class="card-header bg-white border-0 px-4 pt-4 pb-3">

                    @if($role === 'mentor')
                    <span class="badge rounded-pill px-3 py-2 mb-2 d-inline-flex align-items-center gap-2"
                        style="background:#E6F1FB;color:#185FA5;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;">
                        <i class="bi bi-person-check-fill"></i> Mentor
                    </span>
                    <h4 class="fw-semibold mb-1">Create your mentor account</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Share your expertise and guide future researchers</p>
                    @else
                    <span class="badge rounded-pill px-3 py-2 mb-2 d-inline-flex align-items-center gap-2"
                        style="background:#E1F5EE;color:#0F6E56;font-size:11px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;">
                        <i class="bi bi-mortarboard-fill"></i> Mentee
                    </span>
                    <h4 class="fw-semibold mb-1">Create your mentee account</h4>
                    <p class="text-muted mb-0" style="font-size:13px;">Join the research portal and start collaborating</p>
                    @endif

                </div>

                {{-- ── PROGRESS BAR ────────────────────────────────────────── --}}
                <div style="height:3px;background:#e9ecef;">
                    <div id="progressFill"
                        style="height:100%;width:20%;background:{{ $role === 'mentor' ? '#185FA5' : '#0F6E56' }};transition:width .3s;"></div>
                </div>
                {{-- Global error alert (shown on AJAX failure) --}}
                <div id="errorAlert" class="alert alert-danger rounded-3 d-none px-4 py-3 mb-0" role="alert">
                    <div class="d-flex align-items-start gap-2">
                        <i class="bi bi-exclamation-circle-fill mt-1" style="font-size:15px;flex-shrink:0;"></i>
                        <div>
                            <p class="fw-semibold mb-1" style="font-size:13px;">Please fix the following errors:</p>
                            <ul id="errorList" class="mb-0 ps-3" style="font-size:13px;"></ul>
                        </div>
                    </div>
                </div>
                <form id="registerForm">
                    @csrf
                    <input type="hidden" name="role" value="{{ $role }}">

                    {{-- ── ACCOUNT ─────────────────────────────────────────── --}}
                    <div class="px-4 py-4 border-bottom">
                        <p class="section-label text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.07em;">Account</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Full name</label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="e.g. Maria Santos" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Email address</label>
                                <input type="email" name="email" class="form-control"
                                    placeholder="you@university.edu" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password"
                                        class="form-control password-field"
                                        placeholder="Min. 8 characters" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Confirm password</label>
                                <div class="input-group">
                                    <input type="password" name="password_confirmation"
                                        class="form-control password-field"
                                        placeholder="Repeat password" required>
                                    <button type="button" class="btn btn-outline-secondary toggle-password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ── PROFILE ─────────────────────────────────────────── --}}
                    <div class="px-4 py-4 border-bottom">
                        <p class="text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.07em;">Profile</p>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Country</label>
                                <input type="text" name="country" class="form-control" placeholder="e.g. Rwanda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Education level</label>
                                <select name="education_level" class="form-select">
                                    <option value="">Select level</option>
                                    <option>Undergraduate</option>
                                    <option>Graduate (Masters)</option>
                                    <option>PhD / Doctorate</option>
                                    <option>Postdoctoral</option>
                                    <option>Faculty / Professor</option>
                                </select>
                            </div>

                            {{-- MENTOR-ONLY FIELDS --}}
                            @if($role === 'mentor')
                            <div class="col-12">
                                <label class="form-label small fw-medium">Expertise / Specialization</label>
                                <input type="text" name="expertise" class="form-control"
                                    placeholder="e.g. Machine Learning, Genomics, Climate Science">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Organization / University</label>
                                <input type="text" name="organization" class="form-control"
                                    placeholder="Institution name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Academic title</label>
                                <input type="text" name="academic_title" class="form-control"
                                    placeholder="e.g. Dr., Prof., Assoc. Prof.">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Years of experience</label>
                                <input type="number" name="experience_years" class="form-control"
                                    min="0" placeholder="0">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Max mentees</label>
                                <input type="number" name="max_mentees" class="form-control"
                                    min="1" placeholder="5">
                            </div>
                            @endif

                            <div class="col-12">
                                <label class="form-label small fw-medium">Short bio</label>
                                <textarea name="bio" class="form-control" rows="3"
                                    placeholder="Tell collaborators about yourself and your research background..."></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label small fw-medium">Main research goal</label>
                                <input type="text" name="research_goal" class="form-control"
                                    placeholder="e.g. Publish in a peer-reviewed journal by 2025">
                            </div>
                        </div>
                    </div>

                    {{-- ── RESEARCH INTERESTS ──────────────────────────────── --}}
                    <div class="px-4 py-4 border-bottom">
                        <p class="text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.07em;">Research interests</p>

                        {{-- Hidden input collects selected IDs --}}
                        <div id="interestHiddenFields"></div>

                        <label class="form-label small fw-medium">Select or type your interests</label>
                        <div class="tags-box border rounded-3 p-2 d-flex flex-wrap gap-2 align-items-center"
                            id="tagsBox" style="min-height:48px;cursor:text;">
                            <input id="tagInput" type="text"
                                placeholder="Type and press Enter..."
                                class="border-0 outline-none"
                                style="outline:none;min-width:160px;font-size:13px;flex:1;">
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-2" id="suggestions">
                            @foreach($researchInterests as $interest)
                            <button type="button"
                                class="btn btn-sm suggestion-pill rounded-pill border"
                                data-id="{{ $interest->id }}"
                                data-name="{{ $interest->name }}"
                                style="font-size:11px;padding:3px 12px;">
                                {{ $interest->name }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    {{-- ── MENTOR: AVAILABILITY ─────────────────────────────── --}}
                    @if($role === 'mentor')
                    <div class="px-4 py-4 border-bottom">
                        <p class="text-uppercase text-muted fw-semibold mb-3"
                            style="font-size:11px;letter-spacing:.07em;">Availability & Links</p>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox"
                                name="available" id="chkAvailable" value="1"
                                {{ old('available', $mentor->available ?? true) ? 'checked' : '' }}>
                            <label class="form-check-label small" for="chkAvailable">
                                I am currently available for mentoring
                            </label>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">LinkedIn profile</label>
                                <input type="url" name="linkedin_url" class="form-control"
                                    placeholder="https://linkedin.com/in/...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-medium">Research Gate</label>
                                <input type="url" name="google_scholar_url" class="form-control"
                                    placeholder="Research Gate link">
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- ── FOOTER ──────────────────────────────────────────── --}}
                    <div class="px-4 py-3 bg-light d-flex align-items-center justify-content-between">
                        <a href="{{ url('/') }}" class="text-muted text-decoration-none"
                            style="font-size:13px;">← Back</a>
                        <div class="d-flex align-items-center gap-3">
                            <p class="text-muted mb-0" style="font-size:12px;">
                                Already have an account?
                                <a href="{{ route('login') }}" class="fw-medium text-decoration-none">Sign in</a>
                            </p>
                            <button type="submit" id="submitBtn"
                                class="btn text-white px-4 fw-semibold"
                                style="background:{{ $role === 'mentor' ? '#185FA5' : '#0F6E56' }};border-radius:8px;font-size:14px;">
                                Create account
                            </button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

{{-- ── STYLES ──────────────────────────────────────────────────── --}}
<style>
    .form-control,
    .form-select {
        border-radius: 8px;
        font-size: 13px;
        border: 0.5px solid #d1d5db;
        padding: 10px 12px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: {
                {
                $role ==='mentor' ? '#185FA5': '#0F6E56'
            }
        }

        ;

        box-shadow: 0 0 0 3px {
                {
                $role ==='mentor' ? 'rgba(24,95,165,0.1)': 'rgba(15,110,86,0.1)'
            }
        }

        ;
    }

    textarea.form-control {
        resize: none;
    }

    .tag-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;

        background: {
                {
                $role ==='mentor' ? '#E6F1FB': '#E1F5EE'
            }
        }

        ;

        color: {
                {
                $role ==='mentor' ? '#185FA5': '#0F6E56'
            }
        }

        ;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 10px;
        border-radius: 999px;
    }

    .tag-chip button {
        background: none;
        border: none;
        cursor: pointer;
        color: inherit;
        font-size: 15px;
        line-height: 1;
        padding: 0;
    }

    .suggestion-pill.active {
        background: {
                {
                $role ==='mentor' ? '#E6F1FB': '#E1F5EE'
            }
        }

        !important;

        color: {
                {
                $role ==='mentor' ? '#185FA5': '#0F6E56'
            }
        }

        !important;

        border-color: {
                {
                $role ==='mentor' ? '#185FA5': '#1D9E75'
            }
        }

        !important;
    }
</style>

{{-- ── SCRIPTS ─────────────────────────────────────────────────── --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function() {

        const selectedTags = [];
        const accentColor = '{{ $role === "mentor" ? "#185FA5" : "#0F6E56" }}';

        // ── Progress bar ──────────────────────────────────────────────
        function updateProgress() {
            const fields = $('#registerForm input:not([type=hidden]):not([type=checkbox]):not(#tagInput), #registerForm select, #registerForm textarea');
            let filled = 0;
            fields.each(function() {
                if ($(this).val()?.trim()) filled++;
            });
            if (selectedTags.length) filled++;
            const pct = Math.min(95, 15 + Math.round((filled / (fields.length + 1)) * 80));
            $('#progressFill').css('width', pct + '%');
        }

        $('#registerForm').on('input change', updateProgress);

        // ── Toggle password ───────────────────────────────────────────
        $('.toggle-password').on('click', function() {
            const inp = $(this).closest('.input-group').find('.password-field');
            const icon = $(this).find('i');
            inp.attr('type', inp.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('bi-eye bi-eye-slash');
        });

        // ── Tags: add ─────────────────────────────────────────────────
        function addTag(name, id = null) {
            if (selectedTags.find(t => t.name === name)) return;
            const tagId = id || 'custom_' + Date.now();
            selectedTags.push({
                name,
                id: tagId
            });

            const chip = $(`
            <span class="tag-chip" data-name="${name}">
                ${name}
                <button type="button" data-name="${name}">×</button>
            </span>
        `);
            $('#tagsBox').prepend(chip);

            // Hidden input
            const hidden = $(`<input type="hidden" name="interests[]" value="${tagId}">`);
            hidden.attr('id', 'tag_' + tagId);
            $('#interestHiddenFields').append(hidden);

            updateProgress();
        }

        // ── Tags: remove ──────────────────────────────────────────────
        $(document).on('click', '.tag-chip button', function() {
            const name = $(this).data('name');
            const idx = selectedTags.findIndex(t => t.name === name);
            if (idx > -1) {
                $('#tag_' + selectedTags[idx].id).remove();
                selectedTags.splice(idx, 1);
            }
            $(this).closest('.tag-chip').remove();
            $(`.suggestion-pill[data-name="${name}"]`).removeClass('active');
            updateProgress();
        });

        // ── Tags: keyboard input ──────────────────────────────────────
        $('#tagInput').on('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const val = $(this).val().trim();
                if (val) {
                    addTag(val);
                    $(this).val('');
                }
            }
        });

        // ── Suggestion pills ──────────────────────────────────────────
        $(document).on('click', '.suggestion-pill', function() {
            const name = $(this).data('name');
            const id = $(this).data('id');
            if ($(this).hasClass('active')) return;
            $(this).addClass('active');
            addTag(name, id);
        });

        // ── Submit ────────────────────────────────────────────────────
        $('#registerForm').on('submit', function(e) {
            e.preventDefault();

            // Clear all previous errors first
            clearErrors();

            const pass = $('input[name=password]').val();
            const pass2 = $('input[name=password_confirmation]').val();

            if (pass !== pass2) {
                showFieldError('password_confirmation', 'Passwords do not match.');
                scrollToFirstError();
                return;
            }

            Swal.fire({
                title: 'Ready to create your account?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, create it!',
                confirmButtonColor: '{{ $role === "mentor" ? "#185FA5" : "#0F6E56" }}',
            }).then(result => {
                if (!result.isConfirmed) return;

                Swal.fire({
                    title: 'Creating account...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.ajax({
                    url: "{{ route('onboarding.register') }}",
                    method: 'POST',
                    data: $(this).serialize(),

                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Welcome aboard!',
                            timer: 1800,
                            showConfirmButton: false
                        }).then(() => window.location.href = res.redirect);
                    },

                    error: function(xhr) {
                        Swal.close();

                        // ── 422 Validation errors from Laravel ────────────────
                        if (xhr.status === 422 && xhr.responseJSON?.errors) {
                            const errors = xhr.responseJSON.errors;

                            // Show inline errors per field
                            $.each(errors, function(field, messages) {
                                showFieldError(field, messages[0]);
                            });

                            // Show the summary alert at the top
                            showErrorAlert(errors);

                            // Scroll to the first broken field
                            scrollToFirstError();

                            // ── 500 or other server errors ────────────────────────
                        } else {
                            const msg = xhr.responseJSON?.message || 'Something went wrong. Please try again.';
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: msg
                            });
                        }
                    }
                });
            });
        });


        // ── Helpers ───────────────────────────────────────────────────────────────

        function showFieldError(field, message) {
            // Highlight the input border red
            $('[name="' + field + '"]')
                .addClass('is-invalid')
                .closest('.input-group, .col-md-6, .col-12, .col-md-4, .col-md-3')
                .find('.field-error[data-field="' + field + '"]')
                .removeClass('d-none')
                .text(message);

            // Also try direct sibling (outside input-group)
            $('[data-field="' + field + '"]').removeClass('d-none').text(message);
        }

        function showErrorAlert(errors) {
            const $alert = $('#errorAlert');
            const $list = $('#errorList');
            $list.empty();

            $.each(errors, function(field, messages) {
                $list.append('<li>' + messages[0] + '</li>');
            });

            $alert.removeClass('d-none');

            // Auto-hide after 8 seconds
            setTimeout(() => $alert.addClass('d-none'), 8000);
        }

        function clearErrors() {
            // Remove red borders
            $('.form-control, .form-select').removeClass('is-invalid');

            // Hide all inline error spans
            $('.field-error').addClass('d-none').text('');

            // Hide the alert banner
            $('#errorAlert').addClass('d-none');
            $('#errorList').empty();
        }

        function scrollToFirstError() {
            const firstError = $('.is-invalid').first();
            if (firstError.length) {
                $('html, body').animate({
                    scrollTop: firstError.offset().top - 120
                }, 300);
                firstError.focus();
            }
        }

        // Clear a field's error as soon as the user starts correcting it
        $(document).on('input change', '.form-control, .form-select', function() {
            $(this).removeClass('is-invalid');
            const name = $(this).attr('name');
            $('[data-field="' + name + '"]').addClass('d-none').text('');
        });

    });
</script>
@endsection