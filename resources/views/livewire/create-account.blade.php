<div class="h-full w-full create-account">
    @include('partials.merch-header')
<div class="h-full flex justify-center items-center flex-col">
    <h1 class="text-center mb-12 text-3xl">Create an account and<br/>
        Be the owner of your Business</h1>
    <form wire:submit.prevent="createAccount" class="w-1/3" x-data="{ firstNameVal: '', lastNameVal: '', emailVal: '', passVal: '' }">
        <div class="flex space-x-2">
            <div class="flex flex-col relative items-start flex-1">
                <p x-show="firstNameVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">
                    First
                    Name</p>
                <input x-model="firstNameVal"
                       wire:model="firstName"
                       class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                       placeholder="First Name"/>
                @error('firstName') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-col relative items-start flex-1">
                <p x-show="lastNameVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Last
                    Name</p>
                <input x-model="lastNameVal"
                       wire:model="lastName"
                       class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-lg text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                       placeholder="Last Name"/>
                @error('lastName') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="flex flex-col relative items-start flex-1">
            <p x-show="emailVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Email</p>
            <input x-model="emailVal"
                   wire:model="email"
                   class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-lg text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                   placeholder="Email"/>
            @error('email') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
        </div>
        <div class="flex flex-col relative items-start flex-1 mb-6" x-data="{showPass: false}">
            <p x-show="passVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Password</p>
            <div class="flex items-center w-full rounded-md border border-blueGray-300 focus-within:border focus-within:border-black">
                <input x-model="passVal"
                       wire:model="password"
                       :type="!showPass ? 'password' : 'text'"
                       class="px-3 py-3 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-lg text-sm  outline-none focus:outline-none "
                       placeholder="Password"/>
                <div x-on:click="showPass = !showPass"
                     class="flex py-3 pr-3 h-full bg-white rounded-r-md cursor-pointer">
                    <img class="" x-show="!showPass" src="{{asset('images/off.svg')}}"/>
                    <img class="" x-show="showPass" src="{{asset('images/on.svg')}}"/>
                </div>
            </div>
            @error('password') <span class="error mb-4 text-red-400">{{ $message }}</span> @enderror
        </div>
        <p class="text-gray-400 mb-8 text-center"><a target="_blank" class="font-bold text-gray-600" href="/terms-conditions">Terms & Conditions</a> & <a target="_blank" class="font-bold text-gray-600" href="https://www.differentlikeyouinc.com/privacy-policy">Privacy Policy</a></p>
        <button class="bg-yellow-600 w-full flex-0 font-bold btn-primary text-white rounded-lg px-6 py-4">
            Create a free business account
        </button>
        @if (session()->has('error-message'))
            <p class="alert alert-success mt-2 text-center text-red-600" id="alert" >{{ session('error-message') }}</p>
        @endif
    </form>
    <p class="mt-6">Already have a business account? <a href="/merchant-login"><span class="font-bold">Log In</span></a></p>
</div>
</div>
