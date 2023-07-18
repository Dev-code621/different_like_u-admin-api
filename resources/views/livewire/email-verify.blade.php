<div class="h-full w-full">
    @include('partials.merch-header')
    <div class="h-full flex justify-center items-center flex-col w-1/3 mx-auto" x-show="emailSent">
        <img class="mb-6" src="{{asset('images/email-graphic.svg')}}"/>
        <h1 class="text-center text-4xl">Email sent, check your inbox</h1>
        <p class="text-gray-600 my-6 text-center leading-normal">Please click on the verification link that was emailed
            to:
            <br/><span class="font-bold">{{ $email ?? '' }}</span></p>
        <button class="bg-yellow-600 w-full flex-0 font-bold text-white rounded px-6 py-4"
                wire:click="resend" wire:loading.class="bg-gray">
            Resend Verification Email
        </button>
        <div class="mt-8 mb-8 text-center text-green-600" wire:loading wire:target="resend">
            Sending Email...
        </div>
        @if (session()->has('message'))
            <p class="alert alert-success mt-8 mb-8 text-center text-green-600" id="alert" x-data="{ show: true }"
               x-show="show" x-init="setTimeout(() => show = false, 5000)">{{ session('message') }}</p>
        @endif
    </div>
</div>
