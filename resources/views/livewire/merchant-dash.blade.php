<div>
    @include('partials.merchant-dash-header')
    <div class="flex">
        @include('partials.merch-sidebar')
        <div class="" style="width: calc(100% - 13rem)"
             x-data="{ active: window.location.hash ? window.location.hash.substring(1) : 'dashboard' }">
            <div class="p-8" x-show="$store.activePage.page === 1">
                @include('layouts.merchant-home')</div>
            <div class="" x-show="$store.activePage.page === 2">
                @include('layouts.merchant-business')
            </div>
            <div class="" x-show="$store.activePage.page === 3">
                <livewire:merchant-resources/>
            </div>
            <div class="" x-show="$store.activePage.page === 4">
                <livewire:account-setting/>
            </div>
        </div>
    </div>
</div>
