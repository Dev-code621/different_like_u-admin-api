@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))

    <?php
        $claimCount = \App\BusinessProof::where('request_status', 'Pending')->count();
        $pendingClaimClass="";
        if($claimCount>0){
            $pendingClaimClass="pending-claim";
        }
        $icon ="";
        $groupIcon = array(
            'Placeholder'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="currentColor" d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z"/></svg>"
            />',
            'Users Admin'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 48 48"><g fill="none" stroke="currentColor" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"><path d="M24 44c11.046 0 20-8.954 20-20a19.937 19.937 0 0 0-5.845-14.13A19.938 19.938 0 0 0 24 4A19.938 19.938 0 0 0 9.845 9.87A19.937 19.937 0 0 0 4 24c0 11.046 8.954 20 20 20z"/><path d="M4 24h4"/><path d="M9.845 9.87l3.13 3.13"/><path d="M24 4v4"/><path d="M44 24h-4"/><path d="M38.155 9.87L35.025 13"/><path d="M24 20v12"/><path d="M39.852 36.196C36.197 40.942 30.456 44 24 44s-12.195-3.058-15.852-7.804A31.853 31.853 0 0 1 24 32a31.854 31.854 0 0 1 15.852 4.196z"/></g></svg>',
            'Content Manager'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><g stroke-width="1.5" fill="none"><path d="M20.485 3h-3.992l.5 5s1 1 2.5 1a3.23 3.23 0 0 0 2.139-.806a.503.503 0 0 0 .15-.465L21.076 3.5A.6.6 0 0 0 20.485 3z" stroke="currentColor"/><path d="M16.493 3l.5 5s-1 1-2.5 1s-2.5-1-2.5-1V3h4.5z" stroke="currentColor"/><path d="M11.993 3v5s-1 1-2.5 1s-2.5-1-2.5-1l.5-5h4.5z" stroke="currentColor"/><path d="M7.493 3H3.502a.6.6 0 0 0-.592.501L2.205 7.73c-.029.172.02.349.15.465c.328.29 1.061.806 2.138.806c1.5 0 2.5-1 2.5-1l.5-5z" stroke="currentColor"/><path d="M3 9v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9" stroke="currentColor"/><path d="M14.833 21v-6a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v6" stroke="currentColor" stroke-miterlimit="16"/></g></svg>',
            'Other'=>array(
                'Flagged Contents'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z"/></g></svg>',
                'Claim Requests'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path d="M22 22v6H6V4h10V2H6a2 2 0 0 0-2 2v24a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6z" fill="currentColor"/><path d="M29.54 5.76l-3.3-3.3a1.6 1.6 0 0 0-2.24 0l-14 14V22h5.53l14-14a1.6 1.6 0 0 0 0-2.24zM14.7 20H12v-2.7l9.44-9.45l2.71 2.71zM25.56 9.15l-2.71-2.71l2.27-2.27l2.71 2.71z" fill="currentColor"/></svg>',
                'Replies'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z"/></g></svg>',
                'Reviews'=>'<svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 16 16"><g fill="currentColor"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.5 2H9l-.35.15l-.65.64l-.65-.64L7 2H1.5l-.5.5v10l.5.5h5.29l.86.85h.7l.86-.85h5.29l.5-.5v-10l-.5-.5zm-7 10.32l-.18-.17L7 12H2V3h4.79l.74.74l-.03 8.58zM14 12H9l-.35.15l-.14.13V3.7l.7-.7H14v9zM6 5H3v1h3V5zm0 4H3v1h3V9zM3 7h3v1H3V7zm10-2h-3v1h3V5zm-3 2h3v1h-3V7zm0 2h3v1h-3V9z"/></g></svg>',
            )
        );
    ?>
    @foreach($navigation as $group => $resources)

    <?php
        $icon ="";
        $trim = explode(".",$group);
        if(isset($trim[1])){
            $group = $trim[1];
        }
        $icon=$groupIcon['Placeholder'];
        if (array_key_exists($group,$groupIcon)){
            if($group != "Other"){
                if (isset($groupIcon[$group]) && !empty($groupIcon[$group])){
                    $icon = $groupIcon[$group];
                }
            }
        }
    ?>
    @if (count($groups) > 1 && $group != "Other")

        <h4 class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide group-set">
            <!-- <svg> -->
            <?php echo html_entity_decode($icon); ?>
            {{ $group }}
        </h4>

        <ul class="list-reset">
            @foreach($resources as $resource)
                <li class="leading-tight text-sm">
                    <router-link :to="{
                            name: 'index',
                            params: {
                            resourceName: '{{ $resource::uriKey() }}'
                            }
                            }" class=" {{ strtolower($group) }}" dusk="{{ $resource::uriKey() }}-resource-link">
                        {{ $resource::label() }}
                    </router-link>
                </li>
            @endforeach
        </ul>
        @else
        @foreach($resources as $resource)
            <?php
            $icon ="";
            $resourceIcon=$groupIcon['Other'];
                if (isset($resourceIcon) && array_key_exists($resource::label(),$resourceIcon)){
                        if (isset($resourceIcon[$resource::label()]) && !empty($resourceIcon[$resource::label()])){
                            $icon = $resourceIcon[$resource::label()];
                    }
                }
            ?>
                <router-link :to="{
                    name: 'index',
                    params: {
                    resourceName: '{{ $resource::uriKey() }}'
                    }
                    }" class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide text-white text-justify dim {{ strtolower($group) }} {{ $resource::label() == 'Claim Requests' ? $pendingClaimClass : ''  }}" dusk="{{ $resource::uriKey() }}-resource-link">
                        <!-- <svg> -->
                        <?php echo html_entity_decode($icon); ?>
                        {{ $resource::label() }}
                </router-link>
                <!-- </h4> -->
            @endforeach
        @endif
    @endforeach

    <!-- <h3 class="cursor-pointer flex items-center font-normal dim text-white mb-8 text-base no-underline logout"> -->
            <a href="{{ route('nova.logout') }}" class="ml-8 mb-4 text-xs text-white-50% uppercase tracking-wide text-white text-justify dim">
                <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" style="vertical-align: -0.125em;" width="135%" height="135%" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path d="M6 2h9a2 2 0 0 1 2 2v2h-2V4H6v16h9v-2h2v2a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2z" fill="currentColor"/><path d="M16.09 15.59L17.5 17l5-5l-5-5l-1.41 1.41L18.67 11H9v2h9.67z" fill="currentColor"/></svg>
                <span class="text-white sidebar-label">
                    Logout
                </span>
            </a>
    <!-- </h3> -->
@endif
