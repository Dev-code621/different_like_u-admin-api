<div>
    <div class="flex flex-col px-4 py-6 rounded-lg" :class="(expanded) ? 'bg-blue-secondary' : ''"
    >
        <div class="flex space-x-6" :class="expanded && 'text-white'">
            <div class="flex flex-col items-center space-y-2  flex-shrink-0 ml-2">
                <img class="rounded-full h-14 w-14 object-cover" src="{{ !empty($avatar) ? $avatar : Helper::getAvatarPlaceholder() }}"/>
            </div>
            <div class="flex flex-col w-full">
                <div class="flex items-center mb-4">
                    <p class="font-bold leading-none text-gray-400">{{'@'.$reply->user->name}}</p>
                    <div class="h-1 w-1 bg-gray-400 rounded-full mx-1"></div>
                    <p class=" text-xs  leading-none text-gray-400'">{{\Carbon\Carbon::parse($reply->created_at)->format('H:i - d F y')}}</p>
                </div>
                <p class="text-sm mb-4 text-gray-400'">
                    {{$reply->comment}}
                </p>
                <div class="flex w-full justify-between">
                    <div class="flex items-center">
                        <div class="mr-14">
                            <livewire:content-like :reply="$reply"/>
                        </div>
                        <livewire:content-flag :reply="$reply"/>
                    </div>
                </div>
            </div>

        </div>
        @if ($replies->count() === $loop->iteration && $reply->type === 'CONSUMER_REPLY')
            <div x-show="expanded" class="flex flex-col mt-4">
                <p class=" font-bold leading-none mb-4 text-white">Your Reply</p>
                <textarea
                        class="px-3 py-3 mb-4 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                        placeholder="Your comment goes here"
                        wire:model="reviewReply"></textarea>
                <button x-on:click="$wire.postReply(); expanded = false"
                        class="ml-auto px-10 py-3 bg-orange-primary text-white font-bold rounded-lg">
                    Reply
                </button>
            </div>
            <button x-show="!expanded"
                    x-on:click="expanded = true"
                    class="ml-auto px-10 py-3 bg-orange-primary text-white font-bold rounded-lg">
                <p class=" mr-4" x-show="!expanded">Reply</p>
            </button>
        @endif
    </div>
</div>