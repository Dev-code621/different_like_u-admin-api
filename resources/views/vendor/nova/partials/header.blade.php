<div class="header px-view">
    <!-- <div class="content"> -->
      <div class="flex items-center relative h-header">
        <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}" class="no-underline dim font-bold text-90 mr-6">
            <!-- Sacki -->
            <img src="{{asset('images/sacki-logo.png')}}" class="logo" alt="Sacki Logo" width="180" style="">
                        <!-- {{ \Laravel\Nova\Nova::name() }} -->
          </a>
        <dropdown class="ml-auto h-9 flex items-center dropdown-right">
          @include('nova::partials.user')
        </dropdown>
      </div>
    <!-- </div> -->
  <!-- <a href="/admin" class="logo">Sacki</a>
  <div> -->
    <!-- <p>Admin</p> -->
        <!-- @include('nova::partials.user') -->
</div>
