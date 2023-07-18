<div class="w-1/3">
    <div class="flex justify-between items-center w-3/5 mb-4">
        <p class="text-3xl font-bold">Business Info</p>
        <a href="/business-edit-page">
            <button class="flex items-center justify-center p-4 w-16 h-16 rounded-full bg-orange-primary flex-shrink-0">
                <img class="w-8 h-8" src="{{asset('images/edit.svg')}}"/>
            </button>
        </a>
    </div>
    <p class="text-lg font-bold text-secondary-dark mb-2">Location & Hours</p>
    <iframe
            class="rounded-lg shadow-lg mb-2"
            style="border:0"
            loading="lazy"
            allowfullscreen
            src="https://www.google.com/maps/embed/v1/place?key={{ env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'') }}
                    &q=200+Rudy+Cir">
    </iframe>
    <p class="text-secondary-dark text-sm font-medium mb-6">{{$business->default_address}}</p>
{{--    <p class="text-gray-label mb-6 text-sm">Nashville, TN 37214</p>--}}

    <table class="table-fixed flex justify-between   mb-6">
      <tbody class="space-y-2 text-xs text-gray-500 font-medium">
      @if(isset($opening_hours))
        @foreach($opening_hours as $row)
        <?php
            $dayHour = explode(': ', $row);
        ?>
        <tr class="p-8">
          <td class="pr-6 pb-2">{{ $dayHour[0] }}</td>
          <td class="pb-2">{{ $dayHour[1] }}</td>
        </tr>
        <!-- class="text-blue-secondary font-bold" -->
        @endforeach
      @endif
      </tbody>
    </table>

    @if( $business->about)
        <p class="text-lg font-bold text-secondary-dark  mb-2">About</p>
        <p class="text-gray-label w-3/5 mb-6 leading-normal">
            {{ $business->about}}
        </p>
    @endif
    @if($business->links)
        <p class="text-lg font-bold text-secondary-dark font-bold mb-4">Links</p>
        <p class="text-gray-label mb-2 font-bold">Business Website</p>

        <a href="{{$business->links}}" class="text-orange-primary underline">{{$business->links}}</a>
    @endif
    {{--    <p class="text-gray-label mb-2 font-bold mt-4">Other Link</p>--}}
    {{--    <a href="{{$business->other_link}}" class="text-orange-primary underline">{{$business->other_link}}</a>--}}
</div>