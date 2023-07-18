<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use Illuminate\Support\Facades\Storage;
use App\Business;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Mail\MerchantMail;
use Mail;

class AcceptClaim extends Action
{
    use InteractsWithQueue, Queueable;

    public $confirmButtonText = 'Accept Request';
    // public $confirmText = 'Are you sure you want to accept this request?';

    public function __construct($model)
    {
        $this->template = $model;
    }

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return __('Accept Request');
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
            $data['email'] = $model->email;
            $data['phone'] = $model->phone;
            $data['user_id'] = $model->user_id;
            $data['claimed'] = "Accepted";
            $data['claimed_on'] = now();
            Business::where('id', $model->business_id)->update($data);

            $model->update([
                'request_status'=> 'Accepted',
                'reject_reason'=> null
            ]);

            // email
            $user = User::select('email')->where('id', $model->user_id)->first();
            $email=$user->email;
            $template='emails.ClaimAccepted';
            $subject='Sack Business Verification Accepted';
            $body = [
                'merchant_url'=>config('app.url').'/merchant-login',
            ];

            Mail::to($email)->send(new MerchantMail($body, $template,$subject));

        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        if(isset($this->template)){
            return [
                
                Text::make('Business Name', 'name')
                    ->default(function ($request) {
                        if(Business::where('id', $this->template->business_id)->exists()){
                            $businessData = Business::where('id', $this->template->business_id)->firstOrFail();
                            return $value = $businessData->name;
                            // return $this->getPrivateBucket($value);
                        }
                        return $this->template->name;
                    })
                    ->readonly(),
                Text::make('User email', 'name')
                    ->default(function ($request) {
                        if(User::where('id', $this->template->user_id)->exists()){
                            $data = User::where('id', $this->template->user_id)->firstOrFail();
                            return $data->email ;
                        }
                        return false;
                    })
                    ->readonly(),
                Text::make('Business Email Address', 'name')
                    ->default(function ($request) {
                        return $this->template->email;
                    })
                    ->readonly(),
                Text::make('Business Phone')
                    ->default(function ($request) {
                        return $this->template->phone;
                    })
                    ->readonly(),

                Image::make(__('Business Proof'))->disk('s3')
                    ->preview(function($value, $disk) {
                        $value='';
                        if(isset($this->template->id)){
                            $value = $this->template->image;
                            return $this->getPrivateBucket($value);
                        }
                        return false;
                    })
                    ->thumbnail(function($value, $disk) {
                    $value='';
                        if(isset($this->template->id)){
                            $value = $this->template->image;
                            return $this->getPrivateBucket($value);
                        }
                        return false;
                    })
                    ->readonly(),
            ];
        }
    }

    /**
     * Get the image url from private s3 bucket.
     *
     * @param $file
     *
     * @return string
     */
    function getPrivateBucket($file){

        // $file = ''
        $client = Storage::disk('s3')->getDriver()->getAdapter()->getClient();
        $bucket = \Config::get('filesystems.disks.s3.bucket');

        $command = $client->getCommand('GetObject', [
            'Bucket' => $bucket,
            'Key' => $file  // file name in s3 bucket which you want to access
        ]);

        $request = $client->createPresignedRequest($command, '+20 minutes');

        // Get the actual presigned-url
        return $presignedUrl = (string)$request->getUri();
    }
}
