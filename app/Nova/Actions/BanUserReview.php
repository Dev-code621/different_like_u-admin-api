<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Actionable;
use Illuminate\Notifications\Notifiable;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\User;

class BanUserReview extends Action
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
        foreach ($models as $model)
        {
            User::where('id', $model->user_id)->update(['status'=>'BANNED']);

            $model->update([
                'status'=>'UNPUBLISHED',
                'verified'=>'1'
            ]);
        }
        return Action::message('User has been banned and content has been unpublished successfully');
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
