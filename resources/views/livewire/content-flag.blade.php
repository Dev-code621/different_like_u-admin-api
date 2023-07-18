<div x-data="{flagModalOpen: false, flagReason: '', flagged: @entangle('flagged') }">
    <button x-on:click="flagModalOpen = true">
        <img class="h-6 w-6"
             x-bind:src="canReply && flagged ? '{{asset('images/flag-filled-white.svg')}}' : !canReply && flagged ? '{{asset('images/flag-filled.svg')}}' : (canReply || expanded) && !flagged ? '{{asset('images/flag-white.svg')}}' : '{{asset('images/flag-empty.svg')}}'"/>
    </button>
    <div x-cloak x-show="flagModalOpen" style="background: rgba(3, 23, 37, 0.79)"
         class="fixed z-20 left-0 top-0 w-screen h-screen flex justify-center items-center">
        <div class="absolute bg-white rounded-lg w-1/4 overflow-y-auto" style="max-height: 90%;">
            <div x-show="!flagReason">
                <div class="p-4">
                    <button x-on:click="flagModalOpen = false">
                        <img class="ml-auto h-4 w-4" src="{{asset('images/close.svg')}}"/>
                    </button>
                    <p class="text-lg font-bold text-secondary-dark mb-2 w-3/4 mx-auto text-center">Why are you
                        reporting<br/> this content?</p>
                </div>
                <div class="divide-gray-line divide-y border-t border-gray-line">
                    @foreach ($flaggedReasons as $flaggedReason)
                        <button x-on:click="flagReason = '{{$flaggedReason}}'" class="flex justify-between p-4 w-full">
                            <p>{{$flaggedReason}}</p>
                            <img src="{{asset('images/chevron-right.svg')}}"/>
                        </button>
                    @endforeach
                </div>
            </div>
            <div x-show="flagReason">
                <div class="shadow flex justify-between items-center p-4">
                    <button x-on:click="flagReason = ''">
                        <img src="{{asset('images/back-arrow.svg')}}"/>
                    </button>
                    <p class="text-lg font-bold text-secondary-dark text-center">Report</p>
                    <button x-on:click="flagModalOpen = false; flagReason = ''">
                        <img src="{{asset('images/close.svg')}}"/>
                    </button>
                </div>
                <div class="p-4 mt-4 mx-6">
                    <p class="text-lg font-bold text-secondary-dark"><span x-text="flagReason"></span>:</p>
                    <p class="text-lg font-bold text-secondary-dark mb-4">Community Guidelines</p>
                    <p class="font-bold text-gray-label mb-4">We Remove:</p>
                    <ul class="list-disc text-gray-label mb-6 ml-6">
                        <li>Photos or videos of hate speech or symbols.</li>
                        <li>Reviews and replies with captions that encourage violence or attack anyone based on who they
                            are.
                        </li>
                        <li>Specific threats of physical harm, theft or vandalism.</li>
                    </ul>
                    <button x-on:click="$wire.flag(flagReason); flagModalOpen = false;"
                            class="bg-orange-primary flex-0 font-bold text-white rounded-2xl w-full h-12 text-base">
                        Submit
                        Report
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
