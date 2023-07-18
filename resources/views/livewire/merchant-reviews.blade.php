<div class="w-4/6 mr-14">
    <div class="flex justify-between items-center mt-8 mb-4">
        <h3 class="text-4xl mb-4">
            Reviews
        </h3>
        <div class="flex items-end" x-data="{ sort: @entangle('sort') }">
            <p class="text-secondary-dark font-bold mr-4 text-lg">Sort by</p>
            <img x-show="!sort"
                 x-on:click="sort = 'asc'"
                 class="w-8 h-8 cursor-pointer"
                 src="{{asset('images/sort-arrows.svg')}}"/>
            <img x-show="sort === 'desc'"
                 x-on:click="sort = 'asc'"
                 class="w-8 h-8 transform rotate-180 cursor-pointer"
                 src="{{asset('images/arrow-down.svg')}}"/>
            <img x-show="sort === 'asc'"
                 x-on:click="sort = 'desc'"
                 class="w-8 h-8 transform cursor-pointer"
                 src="{{asset('images/arrow-down.svg')}}"/>
        </div>
    </div>
    <div class="divide-gray-line divide-y">
        @if(isset($reviews))
            @foreach($reviews as $review)
                <livewire:single-review :review="$review" :wire:key="'review-' . $review->id"/>
            @endforeach
        @endif
    </div>

</div>
