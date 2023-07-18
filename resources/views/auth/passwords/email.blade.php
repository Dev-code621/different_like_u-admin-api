@extends('layouts.app')

@section('content')
@extends('layouts.header')
@section('logbutton')
    <a href="/register" activeclassname="font-archivo font-bold" class="header-sign-up header-login-logout border-2 border-purple-500 hover:border-gray-50">Sign Up</a>
@endsection
    <div class="container mx-auto">
               <div class="flex content-center flex-wrap justify-center">
             <div class="max-w-md mt-20 text-center">
                 <h3>{{ __('Reset Password') }}</h3>
                <!-- @if (session('status'))
                    <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                        {{ session('status') }}
                    </div>
                @endif -->

                <!-- <div class="login-card"> -->

                    <!-- <div class="login-card-title">
                        {{ __('Reset Password') }}
                    </div> -->

                    <form class="w-full p-4" method="POST" action="{{ route('password.email') }}">
                        @csrf
<!--                        <h2 class="text-2xl text-center font-normal mb-3 text-90">        {{ __('Reset Password') }}</h2>-->

                        <p class="text-center mb-4 reset-p">Enter the email associated with your account and we’ll send an email with instructions to reset your password.</p>

                        @if (session('status'))
                        <div class="text-success text-center font-semibold my-3">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="pure-material-textfield-outlined" for="email">
                                <input placeholder=" " class="" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
                                <span>{{ __('Email Address') }}</span>

                                @if ($errors->has('email'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                             </label>
                        </div>

                           <button type="submit" class="w-full btn btn-default btn-primary continue-btn">
                                {{ __('Send Instructions') }}
                            </button>
                    </form>
                <!-- </div> -->
            </div>
        </div>
    </div>
@endsection
