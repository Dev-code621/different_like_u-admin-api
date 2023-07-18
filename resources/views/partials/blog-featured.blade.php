<div class="flex w-64">
    <img class="w-20 h-16 rounded-lg object-cover mr-2 flex-shrink-0" src="{{ !empty($postData->thumbnail) ? Helper::getPrivateBucket($postData->thumbnail) : Helper::getThumbnailPlaceholder() }}" />
    <div class="">
        <p class="uppercase text-gray-400 text-xs mb-1">{{ $postData->user->name ?? ''}}</p>
        <p class="text-gray-800 text-sm"><a href="/merchant-dash/blog/{{ $postData->id ?? ''}}">{{ $postData->title ?? ''}}</a></p>
    </div>
</div>