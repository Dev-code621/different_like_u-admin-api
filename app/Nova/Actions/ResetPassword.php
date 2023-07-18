<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\User;

class ResetPassword extends Action
{
    use InteractsWithQueue, Queueable;

    public $confirmButtonText = 'Reset Password';

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Reset Password');
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
            $user = User::where('email', $model->email )->first();
            $token = app(\Illuminate\Auth\Passwords\PasswordBroker::class)->createToken($model);

             app(ResetPasswordController::class)->sendmail($model->email, $token);

             // app(ForgotPasswordController::class)->sendmail($model->email);
        }
        return Action::message('We have e-mailed password reset link to '.$model->email);
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
