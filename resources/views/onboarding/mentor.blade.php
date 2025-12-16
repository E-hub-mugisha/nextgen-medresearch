@extends('layouts.join')
@section('content')
<div class="container mt-5">
    <div class="card shadow-lg p-4">
        <h3 class="mb-3 text-center">Mentor Onboarding - {{ ucfirst($role) }}</h3>

        <!-- Progress Bar -->
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width:25%;" id="progressBar"></div>
        </div>

        <!-- Step Indicators -->
        <div class="mb-4 d-flex justify-content-between">
            <div class="step-indicator" id="step1">1</div>
            <div class="step-indicator" id="step2">2</div>
            <div class="step-indicator" id="step3">3</div>
            <div class="step-indicator" id="step4">4</div>
        </div>

        <div id="wizard">
            <!-- Step 1: User Details -->
            <div class="step" data-step="1">
                <div class="mb-3">
                    <input type="text" name="name" placeholder="Full Name" class="form-control form-control-lg">
                </div>
                <div class="mb-3">
                    <input type="email" name="email" placeholder="Email" class="form-control form-control-lg">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" placeholder="Password" class="form-control form-control-lg">
                </div>
                <div class="mb-3">
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control form-control-lg">
                </div>
                <span class="text-danger error-msg"></span>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-gradient-primary next-step">Next</button>
                </div>
            </div>

            <!-- Step 2: Research Interests -->
            <div class="step d-none" data-step="2">
                <div class="mb-3">
                    <label>Research Interests</label>
                    <select name="interests[]" id="interests" class="form-select" multiple="multiple" style="width:100%;">
                        @foreach($researchInterests as $interest)
                        <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                        @endforeach
                    </select>
                </div>
                <span class="text-danger error-msg"></span>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary prev-step">Back</button>
                    <button class="btn btn-gradient-primary next-step">Next</button>
                </div>
            </div>

            <!-- Step 3: Profile Details -->
            <div class="step d-none" data-step="3">
                <div class="mb-3">
                    <input type="text" name="bio" placeholder="Bio" class="form-control form-control-lg">
                </div>
                <div class="mb-3">
                    <input type="text" name="institution" placeholder="Institution" class="form-control form-control-lg">
                </div>
                <span class="text-danger error-msg"></span>
                <div class="d-flex justify-content-between">
                    <button class="btn btn-secondary prev-step">Back</button>
                    <button class="btn btn-gradient-primary next-step">Next</button>
                </div>
            </div>

            <!-- Step 4: Preview & Register -->
            <div class="step d-none" data-step="4">
                <h5 class="mb-3">Preview Your Details</h5>
                <div id="preview"></div>
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-secondary prev-step">Back</button>
                    <button class="btn btn-success finish-step">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
    }

    .btn-gradient-primary:hover {
        opacity: 0.9;
    }

    .step {
        transition: all 0.5s ease;
    }

    .step-indicator {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .step-indicator.active {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
    }

    .progress {
        height: 8px;
        border-radius: 5px;
    }

    .progress-bar {
        transition: width 0.4s ease;
    }
</style>

<!-- Dependencies -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        let currentStep = 1;

        // Initialize Select2
        $('#interests').select2({
            placeholder: "Select or type your research interests",
            tags: true,
            tokenSeparators: [',']
        });


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
                institution: $('input[name=institution]').val()
            };
            return {};
        }

        // Next Step
        $(document).on('click', '.next-step', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('mentor.onboarding.saveStep') }}",
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
                        <p><strong>Institution:</strong> ${$('input[name=institution]').val()}</p>
                        <p><strong>Interests:</strong> ${interestsText}</p>
                    `);
                    }
                    $('.error-msg').text('');
                    showStep(currentStep);
                },
                error: function(xhr) {
                    let msg = 'Something went wrong';
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        msg = Object.values(xhr.responseJSON.errors).map(e => e.join(', ')).join('\n');
                    }
                    $('.step[data-step="' + currentStep + '"] .error-msg').text(msg);
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
        $(document).on('click', '.finish-step', function(e) {
            e.preventDefault();
            let interestsText = $('#interests option:selected').map(function() {
                return $(this).text();
            }).get().join(', ');
            let summary = `
            <p><strong>Name:</strong> ${$('input[name=name]').val()}</p>
            <p><strong>Email:</strong> ${$('input[name=email]').val()}</p>
            <p><strong>Bio:</strong> ${$('input[name=bio]').val()}</p>
            <p><strong>Institution:</strong> ${$('input[name=institution]').val()}</p>
            <p><strong>Interests:</strong> ${interestsText}</p>
        `;

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
                    Swal.fire({
                        title: 'Submitting...',
                        didOpen: () => Swal.showLoading(),
                        allowOutsideClick: false
                    });
                    $.ajax({
                        url: "{{ route('mentor.onboarding.register') }}",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            role: "{{ $role }}",
                            name: $('input[name=name]').val(),
                            email: $('input[name=email]').val(),
                            password: $('input[name=password]').val(),
                            password_confirmation: $('input[name=password_confirmation]').val(),
                            bio: $('input[name=bio]').val(),
                            institution: $('input[name=institution]').val(),
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
                                    })
                                    .then(() => window.location.href = res.redirect);
                            } else {
                                Swal.fire('Error', res.message || 'Registration failed', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.close();
                            let msg = 'Something went wrong. Please try again.';
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                msg = Object.values(xhr.responseJSON.errors).map(e => e.join(', ')).join('\n');
                            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                                msg = xhr.responseJSON.message;
                            }
                            Swal.fire('Error', msg, 'error');
                        },
                        timeout: 15000
                    });
                }
            });
        });

        // Initialize first step
        showStep(currentStep);
    });
</script>
@endsection