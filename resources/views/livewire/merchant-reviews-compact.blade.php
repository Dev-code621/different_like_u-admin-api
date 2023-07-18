<div>
    @if($claimStatus === "Unclaimed")
        <div class="flex rounded-lg border border-gray-line">
            <div class="flex flex-col justify-between  p-8">
                <div>
                    <h3 class="text-2xl mb-6">
                        Verify your Business
                    </h3>
                    <p class="leading-normal">Verify your business to be able to reply to your clients, get
                        metrics,
                        edit your business
                        information, and more!</p>
                </div>
                <a href="/merchant-claim" class="mt-5  md:space-x-3 md:block flex flex-col-reverse">
                    <button class="bg-orange-primary flex-0 font-bold text-white rounded-lg px-6 h-12 text-base">
                        Verify your Business
                    </button>
                </a>
            </div>
            <img src="{{asset('images/verify-man.svg')}}"/>
        </div>
    @elseif($claimStatus === "Pending")
        <div class="flex rounded-lg border border-gray-line">
            <div class="flex flex-col justify-between  p-8">
                <div>
                    <h3 class="text-2xl mb-6">
                        We are processing your request...
                    </h3>
                    <p class="leading-normal">Your request is being analysed by the team at Sacki. Please be
                        patient, we will contact you as soon as possible.</p>
                </div>
                <a href="/merchant-claim" class="mt-5  md:space-x-3 md:block flex flex-col-reverse">
                    <button class="bg-orange-primary flex-0 font-bold text-white rounded-lg px-6 h-12 text-base items-center flex">
                        <img class="mr-2" src="{{asset('images/edit-pencil.svg')}}"/> Edit my Verification Request
                    </button>
                </a>
            </div>
            <img src="{{asset('images/verify-proccessing.svg')}}"/>
        </div>
        @elseif($claimStatus === "Rejected")
        <div class="flex rounded-lg border border-gray-line">
            <div class="flex flex-col justify-between  p-8">
                <div>
                    <h3 class="text-2xl mb-6">
                        Your request has been rejected...
                    </h3>
                    <p class="leading-normal">Your request has been rejected by the team at Sacki.</p>
                    <p class="leading-normal">Reason - {{ $reason ?? '' }}.</p>
                    <p class="leading-normal">We will contact you as soon as possible.</p>
                </div>
                <a href="/merchant-claim" class="mt-5  md:space-x-3 md:block flex flex-col-reverse">
                    <button class="bg-orange-primary flex-0 font-bold text-white rounded-lg px-6 h-12 text-base items-center flex">
                        <img class="mr-2" src="{{asset('images/edit-pencil.svg')}}"/> Edit my Verification Request
                    </button>
                </a>
            </div>
            <img src="{{asset('images/verify-proccessing.svg')}}"/>
        </div>
    @elseif(isset($reviews))
    <h3 class="text-2xl mb-4">
        Your Reviews
    </h3>
        <div class="rounded-lg bg-gray-200 divide-gray-line divide-y rounded-lg overflow-hidden">
            @foreach($reviews as $review)
                @include('partials.single-review-compact', $review)
            @endforeach
        </div>
    @endif
</div>