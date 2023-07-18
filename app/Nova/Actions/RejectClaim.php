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
use App\Mail\MerchantMail;
use Mail;

class RejectClaim extends Action
{
    use InteractsWithQueue, Queueable;

    public $confirmButtonText = 'Reject Request';

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
        return __('Reject Request');
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
            $data['email'] = null;
            $data['phone'] = null;
            $data['user_id'] = null;
            $data['claimed'] = "Unclaimed";
            $data['claimed_on'] = null;
            $data['links'] = null;
            $data['other_link'] = null;
            Business::where('id', $model->business_id)->update($data);

            $model->update([
                'request_status'=> 'Rejected',
                'reject_reason'=> $fields->reason
            ]);

            // email
            $user = User::select('email')->where('id', $model->user_id)->first();
            $email=$user->email;
            $template='emails.ClaimRejected';
            $subject='Sacki Business Verification Rejection';
            $body = [
                'reject_reason'=>$fields->reason,
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
                Select::make('Reason')->options([
                        'Phone Number does not match with Google’s database' => 'Phone Number does not match with Google’s database',
                        'Business Proof file is not clear' => 'Business Proof file is not clear',
                        'Business Proof document is not sufficient' => 'Business Proof document is not sufficient',
                        'Business Email does not match with Google’s database' => 'Business Email does not match with Google’s database',
                        'Need other kind of Business Proof' => 'Need other kind of Business Proof',
                        'Other' => 'Other',
                    ])->rules('required')
                ->help("<b>Why you're rejecting this request?</b>
This will assist your users in identifying the problem so they can send another request."),
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
