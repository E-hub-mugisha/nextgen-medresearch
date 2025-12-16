@extends('layouts.join')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-0 border-0 p-4 p-md-5">

        <h3 class="text-center fw-bold mb-2">
            Let’s get to know you
        </h3>
        <p class="text-center text-muted mb-4">
            Answer a few questions to personalize your experience as a {{ ucfirst($role) }}.
        </p>

        <!-- Progress -->
        <div class="progress mb-4">
            <div class="progress-bar" id="progressBar" style="width:25%; background:#00697E;"></div>
        </div>

        <!-- Step Indicators -->
        <div class="d-flex justify-content-between mb-5">
            @for($i=1;$i<=4;$i++)
                <div class="step-indicator" id="step{{ $i }}">{{ $i }}</div>
        @endfor
    </div>

    <div id="wizard">

        <!-- STEP 1 -->
        <div class="step" data-step="1">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-user"></i> Who are you?</h5>

            <p class="text-muted mb-4">
                We’ll use this information to create your account and secure your access.
            </p>

            <div class="mb-3">
                <label class="form-label">What’s your full name?</label>
                <input type="text" name="name" class="form-control form-control-lg">
            </div>

            <div class="mb-3">
                <label class="form-label">What email should we use?</label>
                <input type="email" name="email" class="form-control form-control-lg">
            </div>

            <div class="mb-3">
                <label class="form-label">Create a password</label>
                <input type="password" name="password" class="form-control form-control-lg">
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm your password</label>
                <input type="password" name="password_confirmation" class="form-control form-control-lg">
            </div>

            <span class="text-danger error-msg"></span>

            <div class="text-end">
                <button class="btn btn-gradient-primary next-step">
                    Continue →
                </button>
            </div>
        </div>

        <!-- STEP 2 -->
        <div class="step" data-step="2" style="display:none;">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-flask"></i> What are your research interests?</h5>

            <p class="text-muted mb-4">
                Select topics you are interested in. This helps us match you with the most relevant mentors.
            </p>

            <div class="mb-4">
                <select id="interests" name="interests[]" class="form-select" multiple style="width:100%">
                    @foreach($researchInterests as $interest)
                    <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                    @endforeach
                </select>
                <small class="text-muted d-block mt-2">
                    You can select multiple or type your own.
                </small>
            </div>

            <span class="text-danger error-msg"></span>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary prev-step">← Back</button>
                <button class="btn btn-gradient-primary next-step">Continue →</button>
            </div>
        </div>

        <!-- STEP 3 -->
        <div class="step" data-step="3" style="display:none;">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-bullseye"></i> Tell us about your goals</h5>

            <p class="text-muted mb-4">
                This information helps mentors understand how to support you effectively.
            </p>

            <div class="mb-3">
                <label class="form-label">Short bio</label>
                <textarea name="bio" class="form-control form-control-lg" rows="2"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">What is your main research goal?</label>
                <input type="text" name="research_goal" class="form-control form-control-lg">
            </div>

            <div class="mb-4">
                <label class="form-label">Current education level</label>
                <input type="text" name="education_level" class="form-control form-control-lg">
            </div>

            <span class="text-danger error-msg"></span>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary prev-step">← Back</button>
                <button class="btn btn-gradient-primary next-step">Review →</button>
            </div>
        </div>

        <!-- STEP 4 -->
        <div class="step" data-step="4" style="display:none;">
            <h5 class="fw-bold mb-3"><i class="fa-solid fa-bullseye"></i> Review your answers</h5>
            <p class="text-muted mb-4">
                Please confirm everything is correct before submitting.
            </p>

            <div id="preview" class="bg-light rounded p-4 mb-4"></div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-outline-secondary prev-step">← Back</button>
                <button class="btn btn-success finish-step">
                    Complete Registration
                </button>
            </div>
        </div>

    </div>
</div>



<style>
    /* Gradient Buttons */
    .btn-gradient-primary {
        background: #00697E;
        color: #fff;
        border: none;
    }

    .btn-gradient-primary:hover {
        opacity: 0.9;
    }

    .step {
        transition: all 0.5s ease;
    }

    .step-indicator.active {
        background: #00697E;
        color: #fff;
    }

    .progress {
        height: 8px;
        border-radius: 5px;
    }

    .progress-bar {
        transition: width 0.4s ease;
    }

    .step-indicator {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #e9ecef;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        color: #00697E;
    }

    .step-indicator.active {
        background: #00697E;
        color: #fff;
    }

    textarea {
        resize: none;
    }
</style>

<!-- Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {

        // Initialize Select2
        $('#interests').select2({
            placeholder: "Select or type your research interests",
            tags: true,
            tokenSeparators: [',']
        });

        let currentStep = 1;

        function showStep(step) {
            $('.step').fadeOut(200, function() {
                $('.step[data-step="' + step + '"]').fadeIn(400);
            });
            updateProgress(step);
            updateIndicators(step);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function updateProgress(step) {
            $('#progressBar').css('width', (step / 4 * 100) + '%');
        }

        function updateIndicators(step) {
            $('.step-indicator').removeClass('active');
            $('#step' + step).addClass('active');
        }

        function collectData(step) {
            if (step == 1) return {
                step: 1,
                name: $('input[name=name]').val(),
                email: $('input[name=email]').val(),
                password: $('input[name=password]').val(),
                password_confirmation: $('input[name=password_confirmation]').val()
            };
            if (step == 2) return {
                step: 2,
                interests: $('#interests').val()
            };
            if (step == 3) return {
                step: 3,
                bio: $('input[name=bio]').val(),
                research_goal: $('input[name=research_goal]').val(),
                education_level: $('input[name=education_level]').val()
            };
            return {};
        }

        // Next Step
        $(document).on('click', '.next-step', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('onboarding.saveStep') }}",
                method: "POST",
                data: {
                    ...collectData(currentStep),
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    currentStep++;
                    if (currentStep == 4) {
                        let interestsText = $('#interests option:selected').map(function() {
                            return $(this).text();
                        }).get().join(', ');
                        $('#preview').html(`
                        <p><strong>Name:</strong> ${$('input[name=name]').val()}</p>
                        <p><strong>Email:</strong> ${$('input[name=email]').val()}</p>
                        <p><strong>Bio:</strong> ${$('input[name=bio]').val()}</p>
                        <p><strong>Research Goal:</strong> ${$('input[name=research_goal]').val()}</p>
                        <p><strong>Education:</strong> ${$('input[name=education_level]').val()}</p>
                        <p><strong>Interests:</strong> ${interestsText}</p>
                    `);
                    }
                    $('.error-msg').text('');
                    showStep(currentStep);
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    $('.step[data-step="' + currentStep + '"] .error-msg').text(Object.values(xhr.responseJSON.errors)[0][0]);
                }
            });
        });

        // Previous Step
        $(document).on('click', '.prev-step', function(e) {
            e.preventDefault();
            if (currentStep > 1) currentStep--;
            showStep(currentStep);
        });

        // Finish & Submit
        // Finish & Submit
        $(document).on('click', '.finish-step', function(e) {
            e.preventDefault();

            // Collect preview data
            let interestsText = $('#interests option:selected').map(function() {
                return $(this).text();
            }).get().join(', ');

            let summary = `
        <p><strong>Name:</strong> ${$('input[name=name]').val()}</p>
        <p><strong>Email:</strong> ${$('input[name=email]').val()}</p>
        <p><strong>Bio:</strong> ${$('input[name=bio]').val()}</p>
        <p><strong>Research Goal:</strong> ${$('input[name=research_goal]').val()}</p>
        <p><strong>Education:</strong> ${$('input[name=education_level]').val()}</p>
        <p><strong>Interests:</strong> ${interestsText}</p>
    `;

            // Confirm details with modal
            Swal.fire({
                title: 'Confirm Your Details',
                html: summary,
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Cancel',
                allowOutsideClick: false
            }).then(result => {
                if (result.isConfirmed) {

                    // Show loader
                    Swal.fire({
                        title: 'Submitting...',
                        html: 'Please wait',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    // Make AJAX request
                    $.ajax({
                        url: "{{ route('onboarding.register') }}",
                        method: "POST",
                        data: {
                            role: "{{ $role }}",
                            _token: "{{ csrf_token() }}",
                            // optionally send all form data here if backend needs it
                            name: $('input[name=name]').val(),
                            email: $('input[name=email]').val(),
                            password: $('input[name=password]').val(),
                            password_confirmation: $('input[name=password_confirmation]').val(),
                            bio: $('input[name=bio]').val(),
                            research_goal: $('input[name=research_goal]').val(),
                            education_level: $('input[name=education_level]').val(),
                            interests: $('#interests').val()
                        },
                        success: function(res) {
                            Swal.close();
                            if (res.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Registered Successfully!',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    window.location.href = res.redirect;
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Registration Failed',
                                    text: res.message || 'Please try again.'
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.close();

                            let msg = 'Something went wrong. Please try again.';
                            // Try to get Laravel validation errors
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                msg = Object.values(xhr.responseJSON.errors).map(e => e.join(', ')).join('\n');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: msg,
                                confirmButtonText: 'OK'
                            });
                        },
                        timeout: 15000 // 15 seconds timeout to prevent infinite loading
                    });
                }
            });
        });


        // Initialize first step
        showStep(currentStep);
    });
</script>
@endsection