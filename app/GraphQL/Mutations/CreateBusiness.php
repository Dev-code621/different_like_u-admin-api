<?php

namespace App\GraphQL\Mutations;
use App\Business;

final class CreateBusiness
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $res = Business::where('google_id',$args['google_id'])->first();
        if($res){
            $res->update($args);
            return $res->refresh();
        }
        return Business::create($args);
    }
}
