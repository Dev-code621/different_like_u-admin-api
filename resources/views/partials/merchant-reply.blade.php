<div class="flex space-x-3 px-4 py-6">
    <div class="flex flex-col items-center space-y-2 ml-2 flex-shrink-0">
        <img class="rounded-full h-16 w-16 object-cover border-4 border-gray-line"
             src="{{ !empty($avatar) ? $avatar : Helper::getAvatarPlaceholder() }}"/>
    </div>
    <div class="flex flex-col  rounded-lg bg-gray-200 p-4 mt-2 flex-1">
        <div class="flex items-center mb-4">
            <p class=" font-bold leading-none">Your Reply</p>
            <div class="h-1 w-1 bg-gray-400 rounded-full mx-1"></div>
            <p class=" text-xs  leading-none text-gray-400'">
                {{\Carbon\Carbon::parse($reply->created_at)->format('H:i - d F y')}}</p>
        </div>
        <p class="text-sm mb-4 text-gray-400">
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