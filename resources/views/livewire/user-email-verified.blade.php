@extends('layouts.app')
<div class="h-full w-full">
    @include('partials.user-header')
    <div class="h-full flex justify-center items-center flex-col" x-show="!emailSent">
        <h1 class="text-center text-4xl">Thanks!</h1>
        <p>Your email has been verified. You may now login.</p>
    </div>
</div>
