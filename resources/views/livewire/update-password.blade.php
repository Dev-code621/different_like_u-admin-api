<div>
    @include('partials.merchant-dash-header')
    <div class="flex font-poppins">
        @include('partials.merch-sidebar')
        <div class="w-full min-h-screen pt-8 px-24 justify-center items-center flex-col">
            <!-- <p>account page</p> -->
            <div class="items-center">
                <h1 class="mb-8 text-4xl">Change Your Password</h1>
            </div>
            <form class="w-1/3" wire:submit.prevent="save" x-data="{ passVal: '', confirmPassVal: '' }">
                @csrf
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
                <button class="mt-8 bg-yellow-600 w-full flex-0 font-bold text-white rounded-2xl px-6 py-4">
                    Update Password
                </button>
                <div class="mt-8 mb-8 text-center text-green-600" wire:loading wire:target="save">
                    Please Wait...
                </div>
                @if (session()->has('message'))
                    <p class="alert alert-success mt-8 mb-8 text-center text-green-600" id="alert" x-data="{ show: true }" x-show="show">{{ session('message') }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
