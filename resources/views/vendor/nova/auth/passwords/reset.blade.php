@extends('nova::auth.layout')

@section('content')

<!-- @include('nova::auth.partials.header') -->

<form
    class="max-w-login mx-auto"
    method="POST"
    action="{{ route('nova.password.request') }}"
>
    {{ csrf_field() }}

    <h2 class="text-2xl text-center font-normal mb-3 text-90">{{ __('Create New Password') }}
    </h2>

    <p class="text-center mb-4 reset-p">Your password must be different from previously used passwords</p>

    @include('nova::auth.partials.errors')

    <input type="hidden" name="token" value="{{ $token }}">

    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="input-email-address">
            <label class="pure-material-textfield-outlined" for="email">
                <input placeholder=" " class="" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                <span>{{ __('Email Address') }}</span>
            </label>
        </div>
    </div>

    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="input-password">
            <label class="pure-material-textfield-outlined" for="password">
                <input placeholder=" " class="password" id="password" type="password" name="password" required>
                <span>{{ __('Password') }}</span>
                <img onclick="passwordVisibility()" class="show-password" src="{{ asset('images/dashboard/On.png') }}">
            </label>
        </div>
    </div>

    <div class="mb-6 {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
        <div class="input-password-confirm">
            <label class="pure-material-textfield-outlined" for="password-confirm">
                <input placeholder=" " class="password" id="password-confirm" type="password" name="password_confirmation" required>
                <span>{{ __('Confirm Password') }}</span>
                <img onclick="passwordVisibilityConfirm()" class="show-password" src="{{ asset('images/dashboard/On.png') }}">
            </label>
        </div>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Send Instructions') }}
    </button>
</form>
@endsection
