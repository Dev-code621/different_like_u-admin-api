<div x-data="{activeUrl: window.location.pathname.substring(
      window.location.pathname.lastIndexOf('/') + 1)}"
     class="bg-blue-secondary flex-shrink-0 w-64 p-5 flex-col items-center justify-start space-y-2  font-poppins">
    <h2 class="font-bold text-white mb-6">{{App\Business::where('user_id', Auth::id())->first()->name ?? ''}}</h2>
    <a class="flex w-full p-2 h-10 items-center rounded text-white cursor-pointer"
       href="/merchant-dash/home"
       :class="activeUrl  === 'home' ? 'bg-white text-blue-secondary font-bold' : ''">
        <img class="h-6 w-6 mr-2"
             x-bind:src="activeUrl  === 'home'  ? '{{asset('images/meter-dark.svg')}}' : '{{asset('images/meter.svg')}}'"/>
        <p>Dashboard</p>
    </a>
    @if(App\Business::where('user_id', Auth::id())->first())
        <a class="flex w-full p-2 h-10 items-center rounded text-white cursor-pointer"
           href="/merchant-dash/business"
           :class="activeUrl  === 'business' ? 'bg-white text-blue-secondary font-bold' : ''">
            <img class="h-6 w-6 mr-2"
                 x-bind:src="activeUrl  === 'business' ? '{{asset('images/shop-dark.svg')}}' : '{{asset('images/shop.svg')}}'"/>
            <p>Business Page</p>
        </a>
    @else
        <a class="flex w-full p-2 h-10 items-center rounded text-white opacity-50">
            <img class="h-6 w-6 mr-2"
                 x-bind:src="activeUrl  === 'business' ? '{{asset('images/shop-dark.svg')}}' : '{{asset('images/shop.svg')}}'"/>
            <p>Business Page</p>
        </a>
    @endif
    <a class="flex w-full p-2 h-10 items-center rounded text-white cursor-pointer"
       href="/merchant-dash/resources"
       :class="activeUrl  === 'resources' ? 'bg-white text-blue-secondary font-bold' : ''">
        <img class="h-6 w-6 mr-2"
             x-bind:src="activeUrl  === 'resources' ? '{{asset('images/book-dark.svg')}}' : '{{asset('images/book.svg')}}'"/>
        <p>Resources</p>
    </a>
    <a class="flex w-full p-2 h-10 items-center rounded text-white cursor-pointer"
       href="/merchant-dash/settings"
       :class="activeUrl  === 'settings' ? 'bg-white text-blue-secondary font-bold' : ''">
        <img class="h-6 w-6 mr-2"
             x-bind:src="activeUrl  === 'settings' ? '{{asset('images/gear-dark.svg')}}' : '{{asset('images/gear.svg')}}'"/>
        <p>Account Settings</p>
    </a>
    <a class="flex w-full p-2 h-10 items-center rounded text-white cursor-pointer"
       :class="activeUrl  === 'logout' ? 'bg-white text-blue-secondary font-bold' : ''"
       href="/logout">
        <img class="h-6 w-6 mr-2"
             x-bind:src="activeUrl  === 'logout' ? '{{asset('images/log-out-dark.svg')}}' : '{{asset('images/log-out.svg')}}'"/>
        <p>Logout</p>
    </a>
</div>

{{--Route::get('/merchant-dash/home', function()--}}
{{--{--}}
{{--return View::make('layouts.merchant-home');--}}
{{--});--}}
{{--Route::get('/merchant-dash/business', function()--}}
{{--{--}}
{{--return View::make('layouts.merchant-business');--}}
{{--});--}}
{{--Route::get('/merchant-dash/resources', App\Http\Livewire\MerchantResources::class);--}}
{{--Route::get('/merchant-dash/settings', App\Http\Livewire\AccountSetting::class);--}}
