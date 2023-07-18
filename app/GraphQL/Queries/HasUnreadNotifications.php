<?php

namespace App\GraphQL\Queries;

use App\PushNotification;

final class HasUnreadNotifications
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $unread = PushNotification::where('user_id', $args["id"])->where('is_read', 0)->get();
        return $unread->isNotEmpty();
    }
}
