@extends('layouts.auth')
@section('title','Login')
@section('content')
<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Sign up</h4>
                <div class="nk-block-des">
                    <p>Create New Dashlite Account</p>
                </div>
            </div>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group"><label class="form-label" for="email">Email or
                    Username</label>
                <div class="form-control-wrap"><input type="text"
                        class="form-control form-control-lg" id="email"
                        placeholder="Enter your email address or username"></div>
            </div>
            <div class="form-group"><label class="form-label" for="password">Passcode</label>
                <div class="form-control-wrap"><a href="#"
                        class="form-icon form-icon-right passcode-switch lg"
                        data-target="password"><em
                            class="passcode-icon icon-show icon ni ni-eye"></em><em
                            class="passcode-icon icon-hide icon ni ni-eye-off"></em></a><input
                        type="password" class="form-control form-control-lg" id="password"
                        placeholder="Enter your passcode"></div>
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
            </div>
        </form>
    </div>
</div>

@endsection