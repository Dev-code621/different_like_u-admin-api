    <div class="flex">
        <img class="{{isset($compact) ? 'h-36 w-80' : 'h-52 w-48'}} object-cover mr-4 rounded-lg" src="{{ !empty($postData->thumbnail) ? Helper::getPrivateBucket($postData->thumbnail) : Helper::getThumbnailPlaceholder() }}"/>
        <div class="flex flex-col justify-between">
            <div class="flex text-xs mt-2">
                <p class="mr-2">{{ !empty($postData->created_at) ? \Carbon\Carbon::parse($postData->created_at)->format('F d, Y') : '' }}</p>
                <p>IN {{ str_replace('_', ' ', $postData->category ?? '') }}</p>
            </div>
            <h4 class="text-secondary-dark text-xl font-bold leading-none">
               <a href="/merchant-dash/blog/{{ $postData->id ?? ''}}"> {{ $postData->title ?? ''}} </a>
            </h4>
            <p class="text-xs">{{ substr($postData->summary ?? '', 0, 125) }}...</p>
            <div class="flex items-center">
                <img src="{{ !empty($postData->user->avatar) ? Helper::getPrivateBucket($postData->user->avatar) : Helper::getAvatarPlaceholder() }}" class="w-8 h-8 mr-4 border-2 border-orange-secondary rounded-full"/>
                <p class="text-xs italic">{{ $postData->user->name ?? ''}}</p>
            </div>
        </div>
    </div>
