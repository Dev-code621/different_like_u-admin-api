<div x-data="{ userLiked: @entangle('userLiked') }" class="flex items-center">
    <button x-on:click="!userLiked && $wire.like()">
        <img class="mr-2 h-6 w-6"
             x-bind:src="canReply && userLiked ? '{{asset('images/heart-filled-white.svg')}}' : !canReply && userLiked ? '{{asset('images/heart-filled.svg')}}' : (canReply || expanded) && !userLiked ? '{{asset('images/heart-white.svg')}}' : '{{asset('images/heart.svg')}}'"/>
    </button>
    <p class="text-xs" x-bind:class="canReply && 'text-white'">{{$likeCount}}</p>
</div>