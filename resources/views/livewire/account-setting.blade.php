@extends('layouts.app')
@include('partials.merchant-dash-header')
<div class="flex font-poppins">
@include('partials.merch-sidebar')
<!-- account page -->
    <div class="w-full min-h-screen pt-8 px-24">
        <!-- <p>account page</p> -->
        <div class="items-center">
            <h1 class="mb-4 text-4xl">Account Settings</h1>
            <!-- <p class="tracking-tight leading-6 text-xl">Following are Sacki resources included in your subscription.</p> -->
        </div>
        <div class="mt-12">
            <div class="w-full mb-6">
                <div class="mb-3 space-y-2 w-full text-sm">
                    <label class="text-2xl font-bold text-blueGray-600 py-2">Business Account Information</label>
                    <div class="text-sm">
                        <p><span class="pt-2 font-semibold">Name:</span> <span
                                    class="text-gray-600">{{Auth::user()->name}} {{Auth::user()->last_name}}</span>
                        </p>
                    </div>
                    <div class="text-sm">
                        <p><span class="pt-2 font-semibold">Email:</span> <span class=" text-gray-600">{{Auth::user()->email}}</span>
                        </p>
                    </div>
                </div>
                @if( $claimStatus == 'Accepted')
                    <a href="/edit-account" class="mt-5  md:space-x-3 md:block flex flex-col-reverse">
                        <button  class="bg-orange-primary flex-0 font-bold text-white rounded-2xl px-6 h-12 text-base">Edit
                        </button>
                    </a>
                @endif
            </div>
        </div>
        <div class="mt-12">
            <div class="w-full mb-6">
                <div class="mb-3 space-y-2 w-full text-sm">
                    <label class="text-2xl font-bold text-blueGray-600 py-2">Change Your Password</label>
                    <div class="text-sm">
                        <p><span class="pt-2 font-semibold">Change the password</span> <span class="text-gray-600">of your business account</span>
                        </p>
                    </div>
                </div>
                <a href="/update-password" class="mt-5 md:space-x-3 md:block flex flex-col-reverse">
                    <button class="bg-orange-primary flex-0 font-bold text-white rounded-2xl px-6 h-12 text-base">Change
                        Password
                    </button>
                </a>
            </div>
        </div>
        <div class="mt-12">
            <div class="w-full mb-6">
                <div class="mb-3 space-y-2 w-full text-sm">
                    <label class="text-2xl font-bold text-blueGray-600 py-2">Email Notifications Settings</label>
                    <div class="text-sm">
                        <p><span class="pt-2 font-semibold">Manage your notification preferences</span> <span
                                    class="text-gray-600">settings</span></p>
                    </div>
                </div>
                <label for="toggle" class="text-sm text-gray-700">Email Notifications</label>
                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                    <input type="checkbox" name="toggle" id="toggle" {{ $status }} {{ $disable }} class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer" wire:model="toggle" wire:click="status" value onclick="getToggleStatus()" />
                    <label for="toggle"
                           class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- account page end  -->
<style>
    /* CHECKBOX TOGGLE SWITCH */
    /* @apply rules for documentation, these do not work as inline style */

    .toggle-checkbox:checked {
        @apply: right-0 border-green-400;
        right: 0;
        border-color: #68d391;
    }

    .toggle-checkbox:checked + .toggle-label {
        @apply: bg-green-400;
        background-color: #68d391;
    }
</style>
@livewireScripts
<script type="text/javascript">

function getToggleStatus() {
  // Get the checkbox
    $("#toggle").attr("disabled", true);
    var checkBox = document.getElementById("toggle");
    if (checkBox.checked == true){
        window.livewire.emit('set:ToggleValue', 1);
    } else {
        window.livewire.emit('set:ToggleValue', 0);
    }
}

window.addEventListener('enableToggle', event => {
        console.log('Name updated to: ');
        window.livewire.emit('show');
    })
document.addEventListener('livewire:load', () => {
    window.livewire.on('show', () => {
    $("#toggle").removeAttr("disabled");
    });
});
</script>