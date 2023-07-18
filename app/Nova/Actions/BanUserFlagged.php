<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Notifications\Notifiable;
use App\Reply;
use App\Review;
use App\User;

class BanUserFlagged extends Action
{
    use InteractsWithQueue, Queueable;
    use Actionable, Notifiable;

    public $confirmButtonText = 'Ban User';

    public $confirmText = 'Are you sure you want to run ban user action?';

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Ban User');
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $type= strtoupper(str_replace(" ","_",$model->type));
            if($type == 'MERCHANT_REPLY' || $type =='CONSUMER_REPLY') {
                $data = Reply::where('id', $model->reply_id)->firstOrFail();
                User::where('id', $data->user_id)->update(['status'=>'BANNED']);
            }
            elseif($type == 'REVIEW') {
                $data = Review::where('id', $model->review_id)->firstOrFail();
                User::where('id', $data->user_id)->update(['status'=>'BANNED']);
            }
            $model->update([
                'status'=>'RESOLVED'
            ]);
        }
        return Action::message('User is banned successfully');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
