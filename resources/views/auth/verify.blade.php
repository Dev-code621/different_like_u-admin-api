@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex content-center flex-wrap justify-center h-screen">
            <div class="w-full max-w-sm">

                @if (session('resent'))
                    <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100  px-3 py-4 mb-4" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <div class="login-card">

                    <div class="login-card-title">
                        {{ __('Verify Your Email Address') }}
                    </div>

                    <div class="w-full flex flex-wrap p-6">
                        <p class="leading-normal mb-6">
                            {{ __('Before proceeding, please check your email for a verification link.') }}
                        </p>

                        <a class="bg-blue-500 hover:bg-blue-700 text-gray-100 font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline no-underline mx-auto" href="{{ route('verification.resend') }}">
                            {{ __('Resend verification email') }}
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
