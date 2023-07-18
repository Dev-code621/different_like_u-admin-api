<?php

namespace App\GraphQL\Mutations;

use App\PushNotification;

final class UpdateNotificationsToRead
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        \DB::table('push_notifications')
            ->where('user_id', $args["user_id"])
            ->update(['is_read' => true]);

        $notifications = PushNotification::where('user_id', $args["user_id"])->get();

        return $notifications;
    }
}
