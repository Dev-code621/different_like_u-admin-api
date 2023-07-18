@if(isset($disabled) && $disabled)
    <a href="" class="cursor-not-allowed">
        <div class="flex flex-col justify-between h-36 bg-gray-offwhite border border-gray-line rounded-lg pt-8 p-6 w-96 opacity-50">
            <p class="text-blue-secondary leading-tight text-lg font-bold pr-12 mb-2">{{$header}}</p>
            <p class="text-md text-gray-label text-md">{{$subhead}}</p>
        </div>
    </a>
@else
    <a href="{{$link}}" class="cursor-allowed">
        <div class="flex flex-col justify-between h-36 bg-gray-offwhite border border-gray-line rounded-lg pt-8 p-6 w-96">
            <p class="text-blue-secondary leading-tight text-lg font-bold pr-12 mb-2">{{$header}}</p>
            <p class="text-md text-gray-label text-md">{{$subhead}}</p>
        </div>
    </a>
@endif