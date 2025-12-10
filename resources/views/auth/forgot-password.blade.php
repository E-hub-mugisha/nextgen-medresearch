@extends('layouts.auth')
@section('title','Forgot your password?')
@section('content')
<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Forgot your password?</h4>
                <div class="nk-block-des">
                    <p>{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
                </div>
            </div>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label class="form-label" for="email">Enter your email</label>
                <div class="form-control-wrap">
                    <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="Enter your email address or username">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Email Password Reset Link</button>
            </div>
        </form>
    </div>
</div>

@endsection