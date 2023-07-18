<div x-data="{expanded: false, canReply: @entangle('canReply'), showReply: true }">
    <div class="flex flex-col px-4 py-6 rounded-lg"
         :class="(canReply && !expanded) ? 'bg-red-error' : (canReply && expanded) ? 'bg-blue-secondary' : ''">
        <div class="flex space-x-6">
            <div class="flex flex-col items-center space-y-2  flex-shrink-0">
                <img class="rounded-full h-16 w-16 object-cover" src="{{ !empty($review->user->avatar) ? Helper::getPrivateBucket($review->user->avatar) : Helper::getAvatarPlaceholder() }}"/>
                <div class="flex justify-between bg-orange-primary rounded-full py-2 px-3 box-content">
                    <img class="mr-3" src="{{asset('images/Star.svg')}}"/>
                    <p class="text-white font-bold">{{$review->overall_score}}</p>
                </div>
                <p class="text-xs font-bold"
                   :class="canReply ? 'text-white' : ' text-gray-label'">{{$review->overall_score}} general</p>
            </div>
            <div class="flex flex-col w-full">
                <div class="flex items-center mb-4">
                    <p class=" font-bold leading-none"
                       :class="canReply ? 'text-white' : 'text-gray-400'">{{'@'.$review->user->name}}</p>
                    <div class="h-1 w-1 bg-gray-400 rounded-full mx-1"></div>
                    <p class=" text-xs  leading-none"
                       :class="canReply ? 'text-white' : 'text-gray-400'">{{\Carbon\Carbon::parse($review->created_at)->format('H:i - d F y')}}</p>
                </div>
                <p class="text-sm mb-4" :class="canReply ? 'text-white' : 'text-gray-400'">
                    {{$review->comment}}
                </p>
                <div class="flex w-full justify-between"
                     :class="showReply && '{{$replies->count() > 0 ? 'border-b border-gray-line pb-4' : ''}}'">
                    <div class="flex items-center">
                        <div class="mr-14">
                            <livewire:content-like :review="$review" :canReply="$canReply"/>
                        </div>
                        <livewire:content-flag :review="$review" :canReply="$canReply"/>
                    </div>
                    <button x-show="canReply"
                            x-on:click="expanded = true"
                            class="flex bg-white text-secondary-dark font-bold py-2 px-8 rounded-lg text-lg ml-auto">
                        <p class=" mr-4" x-show="!expanded">Reply</p>
                        <div class="flex text-red-error"
                             x-data="timer(new Date('{{$reviewExp}}'))"
                             x-init="init();">
                            <p x-text="time().hours"></p><span>:</span>
                            <p x-text="time().minutes"></p><span>:</span>
                            <p x-text="time().seconds"></p>
                        </div>
                    </button>
                </div>
            </div>
        </div>
        @if ($replies->count() === 0)
            <div x-show="expanded" class="flex flex-col mt-4">
                <p class=" font-bold leading-none mb-4 text-white">Your Reply</p>
                <input
                        class="px-3 py-3 mb-4 w-full placeholder-blueGray-300 text-blueGray-600 relative bg-white bg-white rounded-md text-sm border border-blueGray-300 outline-none focus:outline-none focus:border-black"
                        placeholder="Your comment goes here"
                        wire:model="reviewReply"/>
                <button wire:click="postReply"
                        class="ml-auto px-10 py-3 bg-orange-primary text-white font-bold rounded-lg">Reply
                </button>
            </div>
        @endif
    </div>
    @if ($replies->count() > 0)
        <div>
            <div x-show="showReply"
                 class="flex flex-col pb-6 relative space-y-2">
                @foreach ($replies as $reply)
                    <div wire:key="reply-{{$reply->id}}">

                        @if ($reply->type === 'MERCHANT_REPLY')
                            <?php
                            $replyData = App\Review::with('business:id,image')->where('id', $reply->review_id)->first();
                            $avatar = (!empty(strpos($replyData->business->image, 'googleapis') !== false)) ? $replyData->business->image : Helper::getPrivateBucket($replyData->business->image);
                            ?>
                            @include('partials.merchant-reply', ['review' => $review, 'reply' => $reply, 'replies' => $replies, 'avatar' => $avatar])
                        @else
                            <?php
                                $replyData = App\Review::with('user:id,avatar')->where('id', $reply->review_id)->first();
                                $avatar = (!empty(strpos($replyData->user->avatar, 'googleapis') !== false)) ? $replyData->user->avatar : Helper::getPrivateBucket($replyData->user->avatar);
                            ?>
                            @include('partials.consumer-reply', ['reply' => $reply, 'replies' => $replies, 'avatar' => $avatar])
                        @endif
                    </div>
                @endforeach
            </div>
            <a class="text-sm text-orange-primary mx-auto cursor-pointer mt-4 flex items-center justify-center"
               x-on:click="showReply = !showReply">Hide thread <img class="transform ml-2"
                                                                    :class="!showReply && 'rotate-180'"
                                                                    src="{{asset('/images/orange-chevron.svg')}}"/></a>
        </div>
    @endif
    <script>
        function timer(expiry) {
            return {
                expiry: expiry,
                remaining: null,
                init() {
                    this.setRemaining()
                    setInterval(() => {
                        this.setRemaining();
                    }, 1000);
                },
                setRemaining() {
                    const diff = this.expiry - (new Date().getTime() + (new Date().getTimezoneOffset() * 60000));
                    this.remaining = parseInt(diff / 1000);
                    if (this.remaining === 0) {
                        this.canReply = false;
                    }
                },
                hours() {
                    return {
                        value: this.remaining / 3600,
                        remaining: this.remaining % 3600
                    };
                },
                minutes() {
                    return {
                        value: this.hours().remaining / 60,
                        remaining: this.hours().remaining % 60
                    };
                },
                seconds() {
                    return {
                        value: this.minutes().remaining,
                    };
                },
                format(value) {
                    return ("0" + parseInt(value)).slice(-2)
                },
                time() {
                    return {
                        hours: this.format(this.hours().value),
                        minutes: this.format(this.minutes().value),
                        seconds: this.format(this.seconds().value),
                    }
                },
            }
        }
    </script>
</div>
