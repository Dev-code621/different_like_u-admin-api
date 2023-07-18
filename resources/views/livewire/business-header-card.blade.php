<div class="flex flex-col items-start bg-white -mt-40 p-8 rounded-lg shadow">
    <p class="text-sm text-gray-label mb-2">{{$isOpen ? 'Open' : 'Closed'}}</p>
    <p class="text-secondary-dark text-5xl font-bold mb-6">{{$business->name}}</p>
    <div class="flex items-center">
        <div class="flex justify-between bg-orange-primary rounded-lg px-4 py-3 box-content mr-4">
            <img class="mr-1" src="{{asset('images/Star.svg')}}"/>
            <p class="text-white font-bold">{{round($reviewAvg,2)}}</p>
        </div>
        <p class="gray-label text-sm">{{$reviews->count()}} reviews</p>
    </div>
</div>