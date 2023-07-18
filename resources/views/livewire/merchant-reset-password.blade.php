<div class="h-full w-full" x-data="{emailSent : @entangle('isVisible')}">
    @include('partials.merch-header')
    <div class="h-full flex justify-center items-center flex-col" x-show="!emailSent">
        <h1 class="text-center text-4xl">Reset password</h1>
        <p class="text-gray-600 my-6 text-center leading-normal">Enter the email associated with your account and we’ll
            <br/> send an email with instructions to reset your password.</p>
        <form wire:submit.prevent="resetPassword" class="w-1/4" x-data="{ emailVal: ''}">
            <div class="flex flex-col relative items-start flex-1 mb-6" x-data="{showPass: false}">
                <p x-show="emailVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Email
                    Address</p>
                <input x-model="emailVal"
                       wire:model="email"
                       class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                       placeholder="Email"/>
                       @error('email') <span class="error text-red-600">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4">
                Send Instructions
            </button>
            <div class="mt-8 mb-8 text-center text-green-600" wire:loading wire:target="resetPassword">
                Sending Email...
            </div>
            @if (session()->has('error-message'))
            <p class="alert alert-success mt-8 mb-8 text-center text-red-600" id="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ session('error-message') }}</p>
            @endif
            @if (session()->has('message'))
            <p class="alert alert-success mt-8 mb-8 text-center text-green-600" id="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ session('message') }}</p>
            @endif
        </form>
    </div>
    <div x-data="{ emailSent : @entangle('isVisible') }"  class="h-full flex justify-center items-center flex-col w-1/3 mx-auto" x-show="emailSent">
        <img class="mb-6" src="{{asset('images/email-graphic.svg')}}"/>
        <h1 class="text-center text-4xl">Email sent, check your inbox</h1>
        <p class="text-gray-600 my-6 text-center leading-normal">We sent a password recover instruction to your email
            address:
            <br/><span class="font-bold">{{ $email }}</span></p>
        <button class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4"
                wire:click="resendResetPassword" wire:loading.class="bg-gray">
            Resend Reset Email
        </button>
        <div class="mt-8 mb-8 text-center text-green-600" wire:loading wire:target="resendResetPassword">
            Sending Email...
        </div>
        @if (session()->has('message'))
            <p class="alert alert-success mt-8 mb-8 text-center text-green-600" id="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ session('message') }}</p>
        @endif
    </div>
</div>
