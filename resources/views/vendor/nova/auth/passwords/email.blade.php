@extends('nova::auth.layout')

@section('content')

<!-- @include('nova::auth.partials.header') -->
<div>
  <a href="/admin" class="logo"><img src="{{ asset('images/dashboard/back-arrow.png') }}"></a>
</div>
<form
    class="rounded-lg max-w-login mx-auto"
    method="POST"
    action="{{ route('nova.password.email') }}"
>
    {{ csrf_field() }}

    <h2 class="text-2xl text-center font-normal mb-3 text-90">        {{ __('Reset Password') }}
    </h2>

    <p class="text-center mb-4 reset-p">Enter the email associated with your account and we’ll send an email with instructions to reset your password.</p>

    @if (session('status'))
    <div class="text-success text-center font-semibold my-3">
        {{ session('status') }}
    </div>
    @endif

    @include('nova::auth.partials.errors')

    <div class="mb-4 {{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="input-email-address">
            <label class="pure-material-textfield-outlined" for="email">
                <input placeholder=" " class="" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                <span>{{ __('Email Address') }}</span>
            </label>
        </div>
    </div>

    <button class="w-full btn btn-default btn-primary hover:bg-primary-dark" type="submit">
        {{ __('Send Instructions') }}
    </button>
</form>
@endsection
