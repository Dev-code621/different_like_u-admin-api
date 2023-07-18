<?php

namespace App\GraphQL\Queries;

use App\Business;

final class BusinessesByPlaceIds
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $businesses = Business::whereIn('google_id', $args["google_ids"])->get();
        return $businesses;
    }
}
