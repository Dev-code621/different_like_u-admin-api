@extends('layouts.app')
@section('content')
@extends('layouts.header')
@section('logbutton')
    <a href="/register" activeclassname="font-archivo font-bold" class="header-sign-up header-login-logout border-2 border-purple-500 hover:border-gray-50">Sign Up</a>
@endsection
    <div class="container mx-auto">
        <div class="flex content-center flex-wrap justify-center">
             <div class="max-w-md mt-20 text-center">
                    <h3>{{ __('Hello again!') }}</h3>

                    <form class="w-full p-6" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="pure-material-textfield-outlined">
                                <input id="email" type="email" placeholder=" "  name="email" value="{{ old('email') }}" required autofocus>
                            <span>{{ __('E-Mail Address') }}:</span>

                                @if ($errors->has('email'))
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            </label>
                        </div>

                        <div class="flex flex-wrap mb-6  input-password">
                            <label for="password" class="pure-material-textfield-outlined">
                                <input id="password" type="password" placeholder=" " name="password" required>
                                <span>{{ __('Password') }}:</span>
                                <img onclick="passwordVisibility()" class ="show-password" src="{{ asset('images/dashboard/On.png') }}">
                                @if ($errors->has('password'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                            </label>
                        </div>

                       <!--  <div class="flex mb-6">
                            <label class="text-sm text-gray-700" for="remember">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember Me') }}
                            </label>
                        </div> -->

                        @if (Route::has('password.request'))
                            <p class="mb-6">
                                Forgot your password? 
                                <a  class="text-black font-bold hover:text-indigo-700"  href="{{ route('password.request') }}">
                                    {{ __('Reset it now') }}
                                </a>
                            </p>
                        @endif

                        <div class="flex flex-wrap items-center">
                            <button type="submit" class="w-full btn btn-default btn-primary continue-btn">
                                {{ __('Log in') }}
                            </button>

                            <!-- <div class="w-full">
                                <a href="{{ url('login/google') }}" class="w-full flex items-center justify-center btn primary ghost mt-4">
                                    <svg class="h-5 mr-4" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 48 48"><defs><path id="a" d="M44.5 20H24v8.5h11.8C34.7 33.9 30.1 37 24 37c-7.2 0-13-5.8-13-13s5.8-13 13-13c3.1 0 5.9 1.1 8.1 2.9l6.4-6.4C34.6 4.1 29.6 2 24 2 11.8 2 2 11.8 2 24s9.8 22 22 22c11 0 21-8 21-22 0-1.3-.2-2.7-.5-4z"/></defs><clipPath id="b"><use xlink:href="#a" overflow="visible"/></clipPath><path clip-path="url(#b)" fill="#FBBC05" d="M0 37V11l17 13z"/><path clip-path="url(#b)" fill="#EA4335" d="M0 11l17 13 7-6.1L48 14V0H0z"/><path clip-path="url(#b)" fill="#34A853" d="M0 37l30-23 7.9 1L48 0v48H0z"/><path clip-path="url(#b)" fill="#4285F4" d="M48 48L17 24l-4-3 35-10z"/></svg>
                                    <span>MerchantLogin with Google</span>
                                </a>
                            </div> -->

                            @if (Route::has('register'))
                                <p class="w-full text-xs text-center mt-8 -mb-4">
                                    Don’t have an account? 
                                    <a class="primary-text" href="{{ route('register') }}">
                                        Claim your business now!
                                    </a>
                                </p>
                            @endif
                        </div>
                    </form>

               
            </div>
        </div>
    </div>
@endsection
