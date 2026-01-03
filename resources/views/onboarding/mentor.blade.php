@extends('layouts.join')
@section('content')
<div class="container mt-5 mb-5">
    <div class="card shadow-lg p-5 rounded-4">
        <h3 class="mb-4 text-center">Mentor Onboarding</h3>
        <p class="text-center text-muted mb-4">Fill in your details to join as a mentor</p>

        <form id="mentorForm">
            <!-- Account Information -->
            <h5 class="mb-3">Account Information</h5>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Full Name" required>
                </div>
                <div class="col-md-6">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email Address" required>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                    <small class="text-muted">Minimum 6 characters</small>
                </div>
                <div class="col-md-6">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Confirm Password" required>
                </div>
            </div>

            <!-- Profile Information -->
            <h5 class="mb-3 mt-4">Profile Information</h5>
            <div class="mb-3">
                <textarea name="bio" class="form-control form-control-lg" rows="3" placeholder="Short Bio" required></textarea>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <input type="text" name="expertise" class="form-control form-control-lg" placeholder="Expertise" required>
                </div>
                <div class="col-md-6">
                    <input type="text" name="organization" class="form-control form-control-lg" placeholder="Organization" required>
                </div>
            </div>
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <input type="text" name="country" class="form-control form-control-lg" placeholder="Country" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="experience_years" class="form-control form-control-lg" placeholder="Years of Experience" min="0" required>
                </div>
                <div class="col-md-3">
                    <input type="number" name="max_mentees" class="form-control form-control-lg" placeholder="Max Mentees" min="1" required>
                </div>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="available" class="form-check-input" id="available">
                <label class="form-check-label" for="available">Available for mentoring</label>
            </div>

            <div class="d-grid">
                <button type="button" class="btn btn-gradient-primary btn-lg" id="submitBtn">Register</button>
            </div>
            <div class="text-danger mt-3" id="errorMsg"></div>
        </form>
    </div>
</div>

<style>
    .btn-gradient-primary {
        background: linear-gradient(90deg, #4e54c8, #8f94fb);
        color: #fff;
        border: none;
        font-weight: 600;
    }
    .btn-gradient-primary:hover {
        opacity: 0.9;
    }
    .form-control-lg {
        border-radius: 0.75rem;
        padding: 1rem;
        font-size: 1.05rem;
    }
    textarea.form-control-lg {
        resize: none;
    }
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function(){
    $('#submitBtn').click(function(){
        let valid = true;
        $('#mentorForm [required]').each(function(){
            if(!$(this).val()){
                valid=false;
            }
        });

        if(!valid){
            $('#errorMsg').text('Please fill out all required fields');
            return;
        }

        $('#errorMsg').text('');
        const formData = $('#mentorForm').serializeArray();
        const data = {};
        formData.forEach(f => data[f.name] = f.value);

        Swal.fire({
            title:'Confirm Your Details',
            html:'<pre>'+JSON.stringify(data,null,2)+'</pre>',
            icon:'info',
            showCancelButton:true,
            confirmButtonText:'Submit'
        }).then(res=>{
            if(res.isConfirmed){
                Swal.fire({title:'Submitting...',didOpen:()=>Swal.showLoading(),allowOutsideClick:false});
                $.ajax({
                    url:"{{ route('mentor.onboarding.register') }}",
                    method:"POST",
                    data:{...data,_token:"{{ csrf_token() }}",role:"mentor"},
                    success:function(res){
                        Swal.close();
                        if(res.success) window.location.href=res.redirect;
                        else Swal.fire('Error',res.message || 'Registration failed','error');
                    },
                    error:function(xhr){
                        Swal.close();
                        let msg='Something went wrong';
                        if(xhr.responseJSON && xhr.responseJSON.errors){
                            msg=Object.values(xhr.responseJSON.errors).map(e=>e.join(',')).join('\n');
                        }
                        Swal.fire('Error',msg,'error');
                    }
                });
            }
        });
    });
});
</script>
@endsection
