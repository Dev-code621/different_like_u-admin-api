<div x-data="{canReply: {{(isset($review->reply) && $review->reply->count() === 0 && $review->overall_score < 3) ? 'true' : 'false'}}}">
    <div class="flex space-x-6 items-center p-4" x-bind:class="canReply && 'bg-red-error' "
    >
        <img class="rounded-full h-14 w-14 object-cover" src="{{ !empty($review->user->avatar) ? Helper::getPrivateBucket($review->user->avatar) : Helper::getAvatarPlaceholder() }}"/>
        <div class="w-1/5">
            <p class="font-bold mb-2" x-bind:class="canReply && 'text-white'" >{{'@'.$review->user->name}}</p>
            <p class="text-xs" x-bind:class="canReply && 'text-white'" >{{\Carbon\ Carbon::parse($review->created_at)->diffForHumans()}}</p>
        </div>
        <div class="flex bg-orange-primary rounded-full p-2 w-12 flex-shrink-0 box-content">
            <img class="mr-2" src="{{asset('images/Star.svg')}}"/>
            <p class="text-white font-bold">{{$review->overall_score}}</p>
        </div>
        <p class="text-sm w-5/12" x-bind:class="canReply && 'text-white'" >{{$review->comment}}</p>
        <div class="flex-1 flex justify-end">
            <a x-show="canReply"
               href="/merchant-dash/business"
                    class="bg-white text-secondary-dark font-bold py-2 px-8 rounded-lg text-lg ml-auto flex">Reply
                <div class="flex text-red-error ml-4"
                     x-data="timer2(new Date('{{\Carbon\ Carbon::parse($review->created_at)->addHours(48)}}'))"
                     x-show="canReply"
                     x-init="init();">
                    <p x-text="time().hours"></p><span>:</span>
                    <p x-text="time().minutes"></p><span>:</span>
                    <p x-text="time().seconds"></p>
                </div>
            </a>
        </div>
        <script>
            function timer2(expiry) {
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
                        if (!(this.remaining / 3600 <= 48 && this.remaining / 3600 > 0)) {
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
</div>