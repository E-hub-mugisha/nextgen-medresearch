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

        <form id="registrationForm">

            {{-- PERSONAL INFORMATION --}}
            <div class="border rounded p-4 mb-4">
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa-solid fa-user"></i> Personal Information
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-lg" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-lg" required>
                    </div>
                </div>
            </div>

            {{-- PASSWORDS --}}
            <div class="border rounded p-4 mb-4">
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa-solid fa-lock"></i> Security
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control form-control-lg password-field" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Confirm Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" class="form-control form-control-lg password-field" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password">
                                <i class="fa-solid fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RESEARCH INTERESTS --}}
            <div class="border rounded p-4 mb-4">
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa-solid fa-flask"></i> Research Interests
                </h5>

                <div class="row">
                    <div class="col-12">
                        <label class="form-label">Select your interests</label>
                        <select id="interests" name="interests[]" class="form-select" multiple required>
                            @foreach($researchInterests as $interest)
                                <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            {{-- GOALS --}}
            <div class="border rounded p-4 mb-4">
                <h5 class="fw-bold mb-3 text-primary">
                    <i class="fa-solid fa-bullseye"></i> Research Goals
                </h5>

                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label">Short Bio</label>
                        <textarea name="bio" class="form-control form-control-lg" rows="2"></textarea>
                    </div>

                    <div class="col-md-8 mb-3">
                        <label class="form-label">Main Research Goal</label>
                        <input type="text" name="research_goal" class="form-control form-control-lg">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Education Level</label>
                        <input type="text" name="education_level" class="form-control form-control-lg">
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-gradient-primary px-5">
                    Complete Registration
                </button>
            </div>

        </form>
    </div>
</div>

{{-- STYLES --}}
<style>
    .btn-gradient-primary {
        background: #00697E;
        color: #fff;
        border: none;
    }
    .btn-gradient-primary:hover {
        opacity: 0.9;
    }
    textarea {
        resize: none;
    }
</style>

{{-- DEPENDENCIES --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function () {

    // Select2
    $('#interests').select2({
        placeholder: "Select or type your research interests",
        tags: true,
        tokenSeparators: [',']
    });

    // Show / Hide Password
    $('.toggle-password').on('click', function () {
        let input = $(this).closest('.input-group').find('.password-field');
        let icon = $(this).find('i');

        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
            icon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            input.attr('type', 'password');
            icon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Submit
    $('#registrationForm').on('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Confirm Registration',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Submit'
        }).then(result => {
            if (result.isConfirmed) {

                Swal.fire({
                    title: 'Submitting...',
                    allowOutsideClick: false,
                    didOpen: () => Swal.showLoading()
                });

                $.post("{{ route('onboarding.register') }}", {
                    _token: "{{ csrf_token() }}",
                    role: "{{ $role }}",
                    name: $('input[name=name]').val(),
                    email: $('input[name=email]').val(),
                    password: $('input[name=password]').val(),
                    password_confirmation: $('input[name=password_confirmation]').val(),
                    bio: $('textarea[name=bio]').val(),
                    research_goal: $('input[name=research_goal]').val(),
                    education_level: $('input[name=education_level]').val(),
                    interests: $('#interests').val()
                })
                .done(res => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registered Successfully',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => window.location.href = res.redirect);
                })
                .fail(xhr => {
                    let msg = 'Something went wrong';
                    if (xhr.responseJSON?.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join('\n');
                    }
                    Swal.fire('Error', msg, 'error');
                });
            }
        });
    });
});
</script>
@endsection
