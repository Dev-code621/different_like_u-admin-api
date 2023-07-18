<div>
    @include('partials.merchant-dash-header')
    <div class="flex font-poppins">
        @include('partials.merch-sidebar')
        <div class="w-full min-h-screen pt-8 px-24 justify-center items-center flex-col">
            <a href="/account-setting"><img src="{{asset('images/back-arrow.svg')}}"/></a>
            <!-- <p>account page</p> -->
            <div class="items-center pt-4 pb-14">
                <h1 class="mb-8 text-4xl">Edit</h1>
                <p class="font-bold text-2xl">Business Account Information</p>
            </div>
            <form class="w-1/3" wire:submit.prevent="save" >
                @csrf
                <div class="flex flex-col relative items-start flex-1">
                <p x-show="firstNameVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">
                    First
                    Name</p>
                <input
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

            <div class="flex flex-col relative items-start flex-1">
                <p x-show="emailVal" class="-mb-2 leading-none -mt-1 px-2 ml-4 bg-white text-sm font-bold z-10">Email</p>
                <input x-model="emailVal"
                       wire:model="email"
                       class="px-3 py-3 mb-6 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-gray-200 rounded-lg text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                       placeholder="Email" readonly />
                @error('email') <span class="error -mt-4 mb-4 text-red-400">{{ $message }}</span> @enderror
            </div>
                <button class="mt-8 bg-yellow-600 w-full flex-0 font-bold text-white rounded-2xl px-6 py-4">
                    Update
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