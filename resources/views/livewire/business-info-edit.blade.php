<div>
    @include('partials.merchant-dash-header')
    <div class="h-full flex">
        @include('partials.merch-sidebar')
        <div class="" style="width: calc(100% - 13rem)">
            <div id="main" class="grid grid-cols-6">
                <div class="sm:col-span-4 rounded-lg px-10">
                            @include('livewire.business-info-form')
                </div>
                <div class="sm:col-span-2 rounded-lg pr-10">
                            @include('livewire.business-info-reference')
                </div>
            </div>
        </div>
    </div>
</div>