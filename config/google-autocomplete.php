<?php

return [
    // Get your key from https://console.developers.google.com

    'api_key' => env('ADDRESS_AUTOCOMPLETE_API_KEY', SECRET_MANAGER_DATA['ADDRESS_AUTOCOMPLETE_API_KEY']??'')
];