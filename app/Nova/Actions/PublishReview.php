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

class PublishReview extends Action
{
    use InteractsWithQueue, Queueable;
    use Actionable, Notifiable;


    public $confirmButtonText = 'Publish Content';

    public $confirmText = 'Are you sure you want to run publish content action?';
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Publish');
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
            $model->update([
                'status'=>'PUBLISHED',
                'verified'=>1
            ]);
        }
        return Action::message('Content has been published successfully');
       
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
