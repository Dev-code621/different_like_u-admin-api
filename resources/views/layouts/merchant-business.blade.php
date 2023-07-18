@extends('layouts.app')
@include('partials.merchant-dash-header')
<div class="flex font-poppins">
    @include('partials.merch-sidebar')
    <div style="width: calc(100% - 16rem)">
        <div class="flex flex-col w-full h-96 pt-6"
             style="background: linear-gradient(180deg, rgba(0, 49, 82, 0) 29.06%, #003152 100%), center / cover no-repeat url('{{App\Business::where('user_id', Auth::user()->id)->first()->image}}')">
            <a href="/business-edit-page">
                <button class="flex items-center justify-center p-4 rounded-full mr-6 bg-orange-primary ml-auto">
                    <img class="w-8 h-8" src="{{asset('images/Camera.svg')}}"/>
                </button>
            </a>
        </div>
        <div class="flex flex-col items-start p-8">
            <livewire:business-header-card/>
            <div class="flex w-full">
                <livewire:merchant-reviews/>
                <livewire:business-info-display/>
            </div>
        </div>
    </div>
</div>