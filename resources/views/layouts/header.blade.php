<div class="header px-view">
    <!-- <div class="content"> -->
      <div class="flex items-center relative h-header">
        <a v-if="@json(\Laravel\Nova\Nova::name() !== null)" href="{{ \Illuminate\Support\Facades\Config::get('nova.url') }}" class="no-underline dim font-bold text-90 mr-6">
          <img src="{{asset('images/sacki-logo.png')}}" class="logo" alt="Sacki Logo" width="180" style="">
            <!-- {{ \Laravel\Nova\Nova::name() }} -->
        </a>
          <nav class="ml-auto flex items-center ml-auto">
            <a href="#" activeclassname="font-archivo font-bold" class="ml-10 header-contact-menu"> Contact Us</a>
                @yield('logbutton')
            <!-- <button type="button" activeclassname="font-archivo font-bold" class="header-login-logout border-2 border-purple-500 hover:border-gray-50" onClick={this.logout.bind(this)}>Logout</button> -->

            <!--  <a href="/login" activeclassname="font-archivo font-bold" class="header-login-logout border-2 border-purple-500 hover:border-gray-50">Log in</a> -->
          </nav>
      </div>
    <!-- </div> -->
  <!-- <a href="/admin" class="logo">Sacki</a>
  <div> -->
    <!-- <p>Admin</p> -->
</div>
