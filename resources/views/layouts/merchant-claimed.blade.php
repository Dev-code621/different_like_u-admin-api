@extends('layouts.app')
<div x-data class="font-poppins flex flex-col items-center justify-center h-full">
    <p class="text-secondary-dark text-5xl font-bold mb-4">Congratulations!</p>
    <p class="text-gray-800 text-3xl font-bold mb-8">You claimed this business successfully</p>
    <div class="flex p-2 border-2 rounded-lg items-center mb-2">
        <img class="w-20 h-20 object-cover rounded-lg mr-4" src="https://i.pravatar.cc/300"/>
        <div class="flex flex-col justify-between mr-6">
            <div>
                <p class="text-secondary-dark font-bold mb-2">Akira Seabright</p>
                <p class="text-xs text-gray-label">Restaurant</p>
            </div>
            <p class="text-gray-600 text-sm">317 Ventura Drive, Santa Cruz California</p>
        </div>
        <div class="flex justify-between bg-orange-primary rounded-xl px-3 py-2 w-18 box-content mr-4">
            <img class="mr-2" src="{{asset('images/Star.svg')}}"/>
            <p class="text-white font-bold text-lg">4.8</p>
        </div>
    </div>
    <p class="text-lg text-gray-label text-md mb-8">Not your business? <a class="font-bold">Search for a different
            business</a></p>
    <div class="flex flex-col items-center mb-8">
        <p class="text-blue-secondary font-bold text-xl mb-2">Next Steps?</p>
        <p class="text-lg text-gray-800 w-3/4 text-center">Go to your Dashboard and start managing your business today!</p>
    </div>
    <button
            class="flex justify-between bg-orange-primary rounded-xl px-10 py-4 box-content cursor-pointer">
        <p class="text-white font-bold text-md">Take me to Dashboard</p>
    </button>

</div>
