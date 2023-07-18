<?php

namespace App\Observers;

use App\Like;
use App\Notifications\LikeNotification;
use App\Notifications\LikeReviewReply;
use App\PushNotification;
use App\User;
use Illuminate\Support\Facades\Log;
use Throwable;

class LikeObserver
{
    /**
     * Handle the Like "created" event.
     *
     * @param \App\Like $like
     * @return void
     */
    public function created(Like $like)
    {
        if ($like->review_id) {
            $user = $like->review->user;
            $businessName = $like->review->business->name;
        } else if ($like->reply_id) {
            $user = $like->reply->user;
            $businessName = $like->reply->review->business->name;
        }
        $userName = $like->user->name;
        $data = ['userName' => $userName, 'businessName' => $businessName];
        $notification = new PushNotification();
        $notification->user_id = $user->id;
        $notification->text = $userName . ' liked your comment on ' . $businessName;
        $notification->save();
        if (isset($user->fcm_token)) {
            try {
                $user->notify(new LikeReviewReply($data));
            } catch (Throwable $e) {
                report($e);
            }
        }
    }

    /**
     * Handle the Like "updated" event.
     *
     * @param \App\Like $like
     * @return void
     */
    public
    function updated(Like $like)
    {
        //
    }

    /**
     * Handle the Like "deleted" event.
     *
     * @param \App\Like $like
     * @return void
     */
    public
    function deleted(Like $like)
    {
        //
    }

    /**
     * Handle the Like "restored" event.
     *
     * @param \App\Like $like
     * @return void
     */
    public
    function restored(Like $like)
    {
        //
    }

    /**
     * Handle the Like "force deleted" event.
     *
     * @param \App\Like $like
     * @return void
     */
    public
    function forceDeleted(Like $like)
    {
        //
    }
}
