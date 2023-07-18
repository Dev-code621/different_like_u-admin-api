<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use App\Nova\Actions\AcceptClaim;
use App\Nova\Actions\RejectClaim;
use Laravel\Nova\Panel;
use App\BusinessProof;
use Pdmfc\NovaCards\Info;

class ClaimRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\BusinessProof::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'businesses.name',
        'email',
        'phone',
    ];

     /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $sort = [
        'updated_at' => 'asc'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable()->hideFromIndex(),

            BelongsTo::make('Business Name',  'business', 'App\Nova\Business')->readonly()->displayUsing(function ($business) {
                    // $data = User::where('id', $reply->user_id)->firstOrFail();
                    return $business->name;
                })->nullable(),


            Text::make('Business Proof', function () {
                if($this->image){
                //     $proofData = BusinessProof::where('business_id', $this->id)->firstOrFail();
                    return '<a class="no-underline dim text-primary font-bold nova-router-link" href="' . $this->getPrivateBucket($this->image) . '" target="_blank">Open</a>';
                }
                return "<p>Not Found.</p>";
            })->asHtml()->readonly()->onlyOnIndex(),

            Text::make(__('Email'), 'email')->readonly(),
            Text::make(__('Phone Number'), 'phone')->readonly(),
            BelongsTo::make('Merchant Name', 'user', 'App\Nova\Merchant')->hideFromIndex()->readonly(),

            Text::make('Business Proof', function () {
                if($this->image){
                    return '<img src="' . $this->getPrivateBucket($this->image) . '" class="block w-100" draggable="false" width="300" height="300">
                        <a class="no-underline dim text-primary font-bold nova-router-link" href="' . $this->getPrivateBucket($this->image) . '" target="_blank">Open</a>';
                }
                return "<p>Not Found.</p>";
            })->asHtml()->hideFromIndex()->readonly(),
            Text::make('Status', 'request_status')->readonly(),
            Text::make(__('Reject Reason'), 'reject_reason')->readonly()->hideFromIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        $pendingCount=ClaimRequest::where('request_status', 'Pending')->count();
        if($pendingCount > 1){
            return [
                (new Info())
                ->warning($pendingCount.' Requests Pending')
            ];
        }
        elseif($pendingCount < 2){
            return [
                (new Info())
                ->warning($pendingCount.' Request Pending')
            ];
        }
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
         new Filters\ClaimStatus('claimed'),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new AcceptClaim($this))->showOnTableRow(),
            (new RejectClaim($this))->showOnTableRow(),
        ];
    }

    /**
     * Build an "index" query for the given resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query): \Illuminate\Database\Eloquent\Builder
    {

        $query->select(
                'business_proofs.id as id',
                'business_proofs.business_id as business_id',
                'business_proofs.user_id as user_id',
                'business_proofs.phone as phone',
                'business_proofs.email as email',
                'business_proofs.image as image',
                'business_proofs.request_status as request_status',
                'business_proofs.reject_reason as reject_reason',
                'business_proofs.created_at as created_at',
                'business_proofs.updated_at as updated_at',
                'businesses.name as business_name')
            ->leftJoin('businesses', 'businesses.id', '=', 'business_proofs.business_id');
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$sort), reset(static::$sort));
        }

        return $query;
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
