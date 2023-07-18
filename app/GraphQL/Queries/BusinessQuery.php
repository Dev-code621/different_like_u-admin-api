<?php

namespace App\GraphQL\Queries;

use App\Business;
use Illuminate\Support\Facades\DB;

final class BusinessQuery
{
    /**
     * @param null $_
     * @param array{} $args
     */
    public function __invoke($_, array $args)
    {
        $where = [];
        if (!empty($args['where'])){//dynamic where condition
           $where[] = [$args['where']['column'],$args['where']['operator'],$args['where']['value']];
        }
        $businesses =  DB::table('businesses')->where($where)->orderBy('avg_inclusive_score', 'desc')->get();
        $radius = 6378137;
        $businessData = [];
        foreach ($businesses as $business) {
            $lat1 = $args['lat'] ?? 40.782604;
            $lng1 = $args['long'] ?? -73.950676;
            $lat2 = $business->latitude;
            $lng2 = $business->longitude;
            static $x = M_PI / 180;
            $lat1 *= $x;
            $lng1 *= $x;
            $lat2 *= $x;
            $lng2 *= $x;
            $distance = 2 * asin(sqrt(pow(sin(($lat1 - $lat2) / 2), 2) + cos($lat1) * cos($lat2) * pow(sin(($lng1 - $lng2) / 2), 2)));
            if (($distance * $radius) <= 48280.3) {
                $businessData[] = $business;
            };
        }
        return array_slice($businessData, 0, 20) ?? [];
    }
}
