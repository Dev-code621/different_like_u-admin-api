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

class DeleteFlagged extends Action
{
    use InteractsWithQueue, Queueable;
    use Actionable, Notifiable;

    public $confirmButtonText = 'Delete Review';

    public $confirmText = 'Are you sure you want to run delete review/reply action?';

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Delete');
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
            if($type == 'MERCHANT_REPLY' || $type =='CONSUMER_REPLY'){
                Reply::where('id', $model->reply_id)->update(['status'=>'UNPUBLISHED']);
            }
            elseif($type == 'REVIEW') {
                Review::where('id', $model->review_id)->update(['status'=>'DELETE']);
            }
            
            $model->update([
                'status'=>'Post deleted'
            ]);
        }
        return Action::message('Review has been deleted successfully');
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
