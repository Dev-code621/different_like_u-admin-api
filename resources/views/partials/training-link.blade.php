<div class="flex">
    <div class="flex flex-col mr-4">
        <a target="_blank" class="" href="{{ $url ?? '' }}">
            <img class="rounded-lg object-cover h-16 w-16 mb-3" src="{{ !empty($thumbnail) ? Helper::getPrivateBucket($thumbnail) : getThumbnailPlaceholder() }}"/>
        </a>
        <a target="_blank" class="rounded-lg py-2 w-16 text-xs text-white bg-orange-primary text-center font-medium" href="{{ $url ?? '' }}">Visit</a>
    </div>
    <div>
        <a target="_blank" class="" href="{{ $url ?? '' }}"><p class="text-blue-secondary text-lg font-bold mb-4">{{$header}}</p></a>
        <p class="text-gray-400">{{$body}}</p>
    </div>
</div>