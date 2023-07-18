<?php

namespace App\Observers;

use App\Notifications\ReplyNotification;
use App\PushNotification;
use App\Reply;
use App\User;
use Throwable;

class ReplyObserver
{
    /**
     * Handle the Reply "created" event.
     *
     * @param  \App\Reply  $reply
     * @return void
     */
    public function created(Reply $reply)
    {
        if ($reply->where('type', 'MERCHANT_REPLY')->get()) {
            $user = $reply->review->user;
            $userName = $reply->user->name;
            $businessName = $reply->review->business->name;
            $data = ['userName' => $userName, 'businessName' => $businessName];
            $notification = new PushNotification();
            $notification->user_id = $user->id;
            $notification->text = $userName . ' replied to your ' . $businessName . ' review';
            $notification->save();
            if (isset($user->fcm_token)) {
                try {
                $user->notify(new ReplyNotification($data));
                } catch (Throwable $e) {
                    report($e);
                }
            }
        }
    }

    /**
     * Handle the Reply "updated" event.
     *
     * @param  \App\Reply  $reply
     * @return void
     */
    public function updated(Reply $reply)
    {
        //
    }

    /**
     * Handle the Reply "deleted" event.
     *
     * @param  \App\Reply  $reply
     * @return void
     */
    public function deleted(Reply $reply)
    {
        //
    }

    /**
     * Handle the Reply "restored" event.
     *
     * @param  \App\Reply  $reply
     * @return void
     */
    public function restored(Reply $reply)
    {
        //
    }

    /**
     * Handle the Reply "force deleted" event.
     *
     * @param  \App\Reply  $reply
     * @return void
     */
    public function forceDeleted(Reply $reply)
    {
        //
    }
}
