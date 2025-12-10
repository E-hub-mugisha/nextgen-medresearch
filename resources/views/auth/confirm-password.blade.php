@extends('layouts.auth')
@section('title','Confirm your Password')
@section('content')
<div class="card card-bordered">
    <div class="card-inner card-inner-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</h4>
            </div>
        </div>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="form-group">
                <label class="form-label" for="password">
                    Enter your Password
                </label>
                <div class="form-control-wrap">
                    <div class="form-control-wrap">
                        <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                            <em class="passcode-icon icon-show icon ni ni-eye"></em>
                            <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                        </a>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter your passcode">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-lg btn-primary btn-block">Confirm your Password</button>
            </div>

        </form>
    </div>
</div>

@endsection