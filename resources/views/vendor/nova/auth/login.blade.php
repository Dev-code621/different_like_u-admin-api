@extends('nova::auth.layout')

@section('content')

<!-- @include('nova::auth.partials.header') -->

<form
    class="max-w-login mx-auto"
    method="POST"
    action="{{ route('nova.login') }}"
>
    {{ csrf_field() }}

    @component('nova::auth.partials.heading')
        {{ __('Hello again!') }}
    @endcomponent

    @if ($errors->any())
    <p class="text-center font-semibold text-danger my-3">
        @if ($errors->has('email'))
            {{ $errors->first('email') }}
        @else
            {{ $errors->first('password') }}
        @endif
        </p>
    @endif

    <div class="mb-6 {{ $errors->has('email') ? ' has-error' : '' }}">
        <div class="input-email-address">
            <label class="pure-material-textfield-outlined" for="email">
                <input placeholder=" " class="" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                <span>{{ __('Email Address') }}</span>
            </label>
        </div>
    </div>

    <div class="mb-6 {{ $errors->has('password') ? ' has-error' : '' }}">
        <div class="input-password">
            <label class="pure-material-textfield-outlined" for="password">
                <input placeholder=" " class="" id="password" type="password" name="password" required>
                <span>{{ __('Password') }}</span>
                <img onclick="passwordVisibility()" class ="show-password" src="{{ asset('images/dashboard/On.png') }}">
            </label>
        </div>
    </div>

    <div class="flex mb-6">
        <!-- <label class="flex items-center block text-xl font-bold">
            <input class="" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
            <span class="text-base ml-2">{{ __('Remember Me') }}</span>
        </label> -->


        @if (\Laravel\Nova\Nova::resetsPasswords())
        <div class="ml-auto text-primary">
            <p>{{ __('Forgot your password? ') }}</p>
            <a class="text-primary dim font-bold no-underline" href="{{ route('nova.password.request') }}">
                {{ __('Reset it now') }}
            </a>
        </div>
        @endif
    </div>

    <button class="w-full btn btn-default btn-primary" type="submit">
        {{ __('Log in') }}
    </button>
</form>
@endsection
