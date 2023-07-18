@extends('layouts.app')
@section('content')
@extends('layouts.header')
@section('logbutton')
<a href="/login" activeclassname="font-archivo font-bold" class="header-login-logout border-2 border-purple-500 hover:border-gray-50">Log in</a>
@endsection
    <div class="container mx-auto">
        <div class="flex content-center flex-wrap justify-center">
            <div class="w-full mt-20 mb-10 register text-center">
                <h3>{{ __('Create an account and Be the owner of your Business') }}</h3>

                    <form class="w-full p-6" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-wrap mb-6">
                            <label for="first_name" class="pure-material-textfield-outlined">
                                <input id="first_name" type="text" placeholder=" " class="" name="first_name" value="{{ old('first_name') }}" required autofocus>
                                <span>{{ __('First Name') }}</span>
                                @if ($errors->has('first_name'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('first_name') }}
                                    </p>
                                @endif
                            </label>
                        </div>
                            @if($errors->any())
                                <div class="row collapse">
                                    <ul class="alert-box warning radius">
                                        @foreach($errors->all() as $error)
                                            <li> {{ $error }} </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        <div class="flex flex-wrap mb-6">
                            <label for="last_name" class="pure-material-textfield-outlined">
                                <input id="last_name" type="text" placeholder=" " class="" name="last_name" value="{{ old('last_name') }}" required autofocus>
                                <span>{{ __('Last Name') }}</span>

                                @if ($errors->has('last_name'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('last_name') }}
                                    </p>
                                @endif
                            </label>
                        </div>
                        </div>
                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="pure-material-textfield-outlined">
                                <input id="email" type="email" placeholder=" " class="" name="email" value="{{ old('email') }}" required>
                                <span>{{ __('E-Mail Address') }}</span>

                                @if ($errors->has('email'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </label>
                        </div>

                        <div class="flex flex-wrap mb-6 input-password">
                            <label for="password" class="pure-material-textfield-outlined">

                                <input id="password" type="password" placeholder=" " class="" name="password" required>
                                <span>{{ __('Password') }}</span>
                                <img onclick="passwordVisibility()" class ="show-password" src="{{ asset('images/dashboard/On.png') }}">

                                @if ($errors->has('password'))
                                    <p class="text-red-500 text-xs italic mt-4">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                            </label>
                        </div>

                        <div class="flex flex-wrap mb-6 input-password">
                            <label for="password-confirm" class="pure-material-textfield-outlined">
                                <input id="password-confirm" type="password" placeholder=" " class="" name="password_confirmation" required>
                            <span>{{ __('Confirm Password') }}</span>
                            <img onclick="passwordVisibilityConfirm()" class ="show-password" src="{{ asset('images/dashboard/On.png') }}">
                            </label>
                        </div>

                        <p class="w-full text-xs text-center text-gray-700 mt-6 mb-6">
                            Disclaimer/Privacy Policy/Terms & Conditions placeholder et sem ut a ut. Enim eu in pellentesque pretium sed orci, nunc, sed. Porttitor blandit.
                        </p>

                        <div class="flex flex-wrap">
                            <button type="submit" class="w-full btn btn-default btn-primary continue-btn">
                                {{ __('Create a free business account') }}
                            </button>

                            <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                                {{ __('Already have a business account?') }}
                                <a class="text-black font-bold hover:text-indigo-700 no-underline" href="{{ route('login') }}">
                                    Log in
                                </a>
                            </p>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection
