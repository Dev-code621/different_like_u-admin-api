<div class="h-full w-full">
@include('partials.merch-header')
<div class="h-full flex justify-center items-center flex-col">
    <h1 class="text-center mb-8 text-4xl">Create a new password</h1>
    <p class="text-gray-600 my-4 text-center">Your password must be different from<br/> previously used passwords</p>
    <form class="w-1/3" x-data="{ passVal: '', confirmPassVal: '' }" wire:submit.prevent="passwordUpdate">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}" wire:model="email">
        <div class="flex flex-col relative items-start flex-1 mb-6" x-data="{showPass: false}">
            <p x-show="passVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">New Password</p>
            <div class="flex items-center w-full rounded-md border border-blueGray-300 focus-within:border focus-within:border-black">
                <input x-model="passVal"
                       :type="!showPass ? 'password' : 'text'"
                       class="px-3 py-3 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-l-md text-sm  outline-none focus:outline-none "
                       placeholder="New Password" name="password" wire:model="password"/>
                <div x-on:click="showPass = !showPass"
                     class="flex py-3 pr-3 h-full bg-white rounded-r-md cursor-pointer">
                    <img class="" x-show="!showPass" src="{{asset('images/off.svg')}}"/>
                    <img class="" x-show="showPass" src="{{asset('images/on.svg')}}"/>
                </div>
            </div>
            @error('password') <span class="error text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="flex flex-col relative items-start flex-1" x-data="{showPass: false}">
            <p x-show="confirmPassVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Confirm Password</p>
            <div class="flex items-center w-full rounded-md border border-blueGray-300 focus-within:border focus-within:border-black">
                <input x-model="confirmPassVal"
                       :type="!showPass ? 'password' : 'text'"
                       class="px-3 py-3 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-l-md text-sm  outline-none focus:outline-none "
                       placeholder="Confirm Password" name="password_confirmation" wire:model="password_confirmation"/>
                <div x-on:click="showPass = !showPass"
                     class="flex py-3 pr-3 h-full bg-white rounded-r-md cursor-pointer">
                    <img class="" x-show="!showPass" src="{{asset('images/off.svg')}}"/>
                    <img class="" x-show="showPass" src="{{asset('images/on.svg')}}"/>
                </div>
            </div>
            @error('password_confirmation') <span class="error text-red-600">{{ $message }}</span> @enderror
            @error('email') <span class="error text-red-600" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $message }}</span> @enderror
        </div>
        <p class="mt-8 mb-8 text-center">Forgot your password?<span class="font-bold"> Reset It Now</span></p>
        <button class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4">
            Update Password
        </button>
        <div class="mt-8 mb-8 text-center text-green-600" wire:loading wire:target="passwordUpdate">
            Please Wait...
        </div>
        @if ($error)
            <p class="alert alert-success mt-8 mb-8 text-center text-red-600" id="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ $error }}</p>
        @endif
        @if (session()->has('message'))
            <p class="alert alert-success mt-8 mb-8 text-center text-green-600" id="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ session('message') }}</p>
        @endif
    </form>
</div>
</div>
