<div class="flex justify-between items-center shadow-xl px-10 h-24">
    <a class="no-underline dim font-bold text-4xl mr-6">
        <img src="{{asset('images/sacki-logo.png')}}" class="logo" alt="Sacki Logo" width="150" style="">    </a>
    <div class="flex items-center gap-10">
        <div class="dim font-bold">
            <a target="_blank" href="https://www.differentlikeyouinc.com/faqs">FAQ</a>
        </div>
        <div class="dim font-bold">
            <a href="mailto:support@differentlikeyouinc.com">Contact Us</a>
        </div>
        <a>
            <img src="{{asset('images/bell.svg')}}"/>
        </a>
        <div class="relative" x-cloak x-data="{ open: false }" x-on:click.outside="open = false">
            <div class="flex items-center cursor-pointer p-2 -mb-2 -mt-2 "
                 x-bind:class="open ? 'border-4 border-gray-400 border rounded-lg  shadow-xl' : ''"
                 x-on:click="open = !open">
                @if(App\Business::where('user_id', Auth::user()->id)->first())
                <?php
                    $avatar = App\Business::where('user_id', Auth::user()->id)->first()->image;
                    if (strpos($avatar, 'googleapis') !== false) {
                        $avatarImage = $avatar;
                    }
                    else{
                        $avatarImage = Helper::getPrivateBucket($avatar);
                    }
                ?>
                    <img src="{{!empty($avatar) ? $avatarImage : Helper::getAvatarPlaceholder()}}"
                         class="w-14 h-14 mr-2 border-2 border-orange-secondary rounded-full"/>
                @endif
                <img class="transform transition-all" x-bind:class="open ? 'rotate-180' : ''"
                     src="{{asset('images/chevron-down.svg')}}"/>
            </div>
            <ul x-show="open"
                class="absolute bg-white p-4 rounded-lg rounded-tr-none border border-4 border-gray-400 shadow-xl  right-0 top-18 w-60">
                <li class="flex gap-2 mb-4"><img src="{{asset('images/gear-dark.svg')}}"/><a
                            href="/merchant-dash/settings">Account Settings</a></li>
                <li class="flex gap-2"><img src="{{asset('images/log-out-dark.svg')}}"/><a href="/logout">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</div>