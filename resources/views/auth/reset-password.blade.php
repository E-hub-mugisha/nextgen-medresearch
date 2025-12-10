@extends('layouts.auth')
@section('title','Reset Password')
@section('content')
<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Reset Password</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="form-group"><label class="form-label" for="email">Email or
                    Username</label>
                <div class="form-control-wrap"><input type="text"
                        class="form-control form-control-lg" id="email" name="email"
                        placeholder="Enter your email address or username"></div>
            </div>
            <div class="form-group"><label class="form-label" for="password">Passcode</label>
                <div class="form-control-wrap"><a href="#"
                        class="form-icon form-icon-right passcode-switch lg"
                        data-target="password"><em
                            class="passcode-icon icon-show icon ni ni-eye"></em><em
                            class="passcode-icon icon-hide icon ni ni-eye-off"></em></a><input
                        type="password" class="form-control form-control-lg" id="password" name="password"
                        placeholder="Enter your passcode"></div>
            </div>
            <div class="form-group"><label class="form-label" for="password">Confirm Passcode</label>
                <div class="form-control-wrap"><a href="#"
                        class="form-icon form-icon-right passcode-switch lg"
                        data-target="password"><em
                            class="passcode-icon icon-show icon ni ni-eye"></em><em
                            class="passcode-icon icon-hide icon ni ni-eye-off"></em></a><input
                        type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation"
                        placeholder="Re-Enter your passcode"></div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Reset Password</button>
            </div>
        </form>
    </div>
</div>

@endsection