<?php

namespace App\Nova;

use EmilianoTisato\GoogleAutocomplete\AddressMetadata;
use EmilianoTisato\GoogleAutocomplete\GoogleAutocomplete;
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

class Business extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Business::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static $displayInNavigation = false;

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
            GoogleAutocomplete::make('place')->hideFromIndex()->withMeta([
                'countries' => ['US'],
                'placeType' => 'establishment'
            ])->withValues([
                'place_id',
                'name',
            ])->fillUsing(function(NovaRequest $request, $model, $attribute, $requestAttribute) {
                return null;
            })->hideFromDetail(),
            AddressMetadata::make('Google Id','google_id')->fromValue('{{place_id}}')->disabled()->hideFromIndex() ,
            AddressMetadata::make('Name','name')->fromValue('{{name}}')->disabled(),
            Image::make(__('Image'),'image')->disk('s3')
                ->preview(function($value, $disk) {
                    if (is_null($value)) {
                        return $value;
                    }
                    if (filter_var($value, FILTER_VALIDATE_URL)) {
                        return $value;
                    }
                    return $this->getPrivateBucket($value);
                })->thumbnail(function($value, $disk) {
                    if (is_null($value)) {
                        return $value;
                    }
                    if (filter_var($value, FILTER_VALIDATE_URL)) {
                        return $value;
                    }
                    return $this->getPrivateBucket($value);
                })->hideFromIndex(),
            Textarea::make('About')->alwaysShow(),
            Text::make(__('About'), function () {
                return Str::limit($this->about,30);
            })->onlyOnIndex(),
            Text::make('Link','links')->sortable(),
            Text::make('Other Link','other_link')->sortable(),
            Text::make('Claim Status','claimed'),
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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
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
        return [];
    }

    /**
     * Get the image url from private s3 bucket.
     *
     * @param $file
     *
     * @return string
     */
    function getPrivateBucket($file){
        if(!empty($file)){
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
}
