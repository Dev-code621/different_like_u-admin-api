<div class="w-1/2">
    <h3 class="text-2xl mb-6">
        Your Metrics
    </h3>
    <div class="flex shadow rounded-lg p-8 border-2 mb-6">
        <div class="rounded-xl bg-orange-primary flex-shrink-0 h-32 w-32 flex flex-col justify-center items-center">
            <div class="flex items-center">
                <img class="mr-2 h-5 w-5" src="{{asset('images/Star.svg')}}"/>
                <p class="text-white text-3xl font-bold">{{round($inclusivityScore,2)}}</p>
            </div>
            <p class="text-white text-xl ">Inclusivity</p>
        </div>
        <div class="flex flex-col ml-8">
            <h4 class="text-2xl font-bold text-secondary-dark mb-8">
                Rating
            </h4>
            <p class="text-lg">
                You’re just <span class="text-green-success font-bold">{{5 - round($inclusivityScore,2)}}</span> points away of getting featured in
                front of all
                our diverse audience!
            </p>
        </div>
    </div>
    <div class="flex space-x-6">
{{--        <div class="p-8 shadow rounded-lg border-2 flex flex-col items-center flex-1 space-y-4">--}}
{{--            <p class="text-secondary-dark font-bold">Page Visits</p>--}}
{{--            <p class="text-5xl text-secondary-blue font-bold">16,836</p>--}}
{{--            <p>Last Year</p>--}}
{{--        </div>--}}
        <div class="p-8 shadow rounded-lg border-2 flex flex-col items-center flex-1 space-y-4">
            <div class="font-bold text-secondary-dark "><span class="text-orange-primary font-extrabold">{{$reviews ? $reviews->count() : 0}}</span>
                Reviews
            </div>
            <div class="flex justify-between space-x-4">
                <div class="flex flex-col items-center text-green-success">
                    <p class="text-5xl font-bold mb-4">{{$reviewHigh}}</p>
                    <div class="flex items-center"><p class="mr-1">+3.0</p><img
                                src="{{asset('images/Star-fill.svg')}}"/></div>
                </div>
                <div class="flex flex-col items-center text-red-error">
                    <p class="text-5xl font-bold mb-4">{{$reviewLow}}</p>
                    <div class="flex items-center"><p class="mr-1">-3.0</p><img
                                src="{{asset('images/Star-empty.svg')}}"/></div>
                </div>
            </div>
        </div>
    </div>
</div>
