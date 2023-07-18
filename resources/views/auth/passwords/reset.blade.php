@extends('layouts.app')

@section('content')
@section('content')
@extends('layouts.header')
@section('logbutton')
    <a href="/register" activeclassname="font-archivo font-bold" class="header-sign-up header-login-logout border-2 border-purple-500 hover:border-gray-50">Sign Up</a>
@endsection
    <div class="container mx-auto">
        <div class="flex content-center flex-wrap justify-center">
            <div class="px-view py-view mx-auto mt-20">
                <!-- <div class="login-card"> -->

                    <!-- <div class="login-card-title">
                        {{ __('Reset Password') }}
                    </div> -->

                    <form class="set-password mx-auto" method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <h2 class="text-2xl text-center font-normal mb-3 text-90">{{ __('Create New Password') }}</h2>

                        <p class="text-center mb-4 reset-p">Your password must be different from previously used passwords</p>

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="mb-6">
                            <div class="input-email-address">
                                <label class="pure-material-textfield-outlined" for="email">
                                    <input placeholder=" " class="" id="email" type="email" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                    <span>{{ __('Email Address') }}</span>
                                </label>
                                @if ($errors->has('email'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="input-password">
                                <label class="pure-material-textfield-outlined" for="password">
                                    <input placeholder=" " class="password" id="password" type="password" name="password" required>
                                    <span>{{ __('Password') }}</span>
                                    <img onclick="passwordVisibility()" class="show-password" src="{{ asset('images/dashboard/On.png') }}">
                                    @if ($errors->has('password'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                                </label>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="input-password-confirm">
                                <label class="pure-material-textfield-outlined" for="password-confirm">
                                    <input placeholder=" " class="" id="password-confirm" type="password" name="password_confirmation" required>
                                    <span>{{ __('Confirm Password') }}</span>
                                    <img onclick="passwordVisibilityConfirm()" class="show-password" src="{{ asset('images/dashboard/On.png') }}">
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-wrap items-center">
                            <button type="submit" class="w-full btn btn-default btn-primary continue-btn">
                                {{ __('Reset Password') }}
                            </button>
                        </div>
                    </form>

                <!-- </div> -->
            </div>
        </div>
    </div>
@endsection
