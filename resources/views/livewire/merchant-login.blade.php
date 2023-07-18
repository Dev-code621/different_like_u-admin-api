<div class="h-full w-full">
    @include('partials.merch-header')
    <div class="h-full flex justify-center items-center flex-col">
        <h1 class="text-center mb-12 text-4xl">Hello again!</h1>
        @if (session()->has('reset-message'))
            <p class="alert alert-success mt-8 mb-8 text-center text-green-600" id="alert" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 8000)">{{ session('reset-message') }}</p>
        @endif
        <form wire:submit.prevent="submit" class="w-1/3" x-data="{ emailVal: '', passVal: '' }">
            <div class="flex flex-col relative items-start flex-1">
                <p x-show="emailVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Email
                    Address</p>
                <input x-model="emailVal"
                       wire:model="email"
                       class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                       placeholder="Email"/>
                @error('email') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-col relative items-start flex-1" x-data="{showPass: false}">
                <p x-show="passVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">
                    Password</p>
                <div class="flex mb-4 items-center w-full rounded-md border border-blueGray-300 focus-within:border focus-within:border-black">
                    <input x-model="passVal"
                           wire:model="password"
                           :type="!showPass ? 'password' : 'text'"
                           class="px-3 py-3 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-l-md text-sm  outline-none focus:outline-none "
                           placeholder="Password"/>
                    <div x-on:click="showPass = !showPass"
                         class="flex py-3 pr-3 h-full bg-white rounded-r-md cursor-pointer">
                        <img class="" x-show="!showPass" src="{{asset('images/off.svg')}}"/>
                        <img class="" x-show="showPass" src="{{asset('images/on.svg')}}"/>
                    </div>
                </div>
            </div>
            @error('password') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
            <p class="mt-4 mb-8 text-center">Forgot your password?<a href="/reset-password" class="font-bold"> Reset It Now</a></p>
            <button type="submit" class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4">
                Log In
            </button>
        </form>
        <p class="mt-8 mb-8">Don't have an Account?<a href="/create-account"><span
                    class="font-bold text-orange-primary"> Create one now!</span></a></p>
    </div>
</div>