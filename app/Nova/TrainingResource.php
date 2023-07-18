<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Support\Str;
use App\Nova\Actions\DraftContent;
use App\Nova\Actions\PublishContent;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Image;
use Illuminate\Support\Facades\Storage;
use Helper;

class TrainingResource extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\TrainingResource::class;

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
        'id',
        'name',
        'url',
        'description',
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = '2.Content Manager';

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return __('Training Resources');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Training Resource');
    }

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
            Text::make(__('Resource Name'), 'name')->rules('required')->sortable()->placeholder('Name'),
            Text::make('Status')->exceptOnForms()->displayUsing(function ($status) {
                return ucwords(strtolower(str_replace('_', ' ', $status)));
            }),
            Text::make(__('URL Link'), 'url')->rules('required')->sortable()->placeholder('Link to the resource page')->hideFromIndex(),
            Textarea::make(__('Description'), 'description')->placeholder('Summary')->help('A summary of the training resource that will appear on the training resources grids (Merchant’s Resources Page). Make it upto 140 characters.')->alwaysShow()->withMeta(['extraAttributes' => ['maxlength' => 140],['warningAt' => 100]])->rules('required'),
            Text::make(__('Description'), function () {
                return Str::limit($this->description,30);
            })->onlyOnIndex(),
            Image::make(__('Thumbnail image'), 'thumbnail')->disk('s3')->help('Smaller version of the Main image that will go on the blog posts grids (Merchant’s Dashboard & Resources)')
                ->preview(function($value, $disk) {
                    if (is_null($value)) {
                        return $value;
                    }
                    if (filter_var($value, FILTER_VALIDATE_URL)) {
                        return $value;
                    }
                    return Helper::getPrivateBucket($value);
                })->thumbnail(function($value, $disk) {
                    if (is_null($value)) {
                        return $value;
                    }
                    if (filter_var($value, FILTER_VALIDATE_URL)) {
                        return $value;
                    }
                    return Helper::getPrivateBucket($value);
                })->hideFromIndex(),
            Select::make('Status')->options([
                'DRAFT' => 'Draft',
                'PUBLISHED' => 'Published',
            ])->resolveUsing(function () {
                return $this->status ?? 'DRAFT';
            })->displayUsingLabels()->onlyOnForms()->rules('required'),
            DateTime::make(__('Created'),'created_at')->format('LLL')->onlyOnIndex()->sortable(),
            DateTime::make(__('Modified'),'updated_at')->format('LLL')->onlyOnIndex()->sortable(),
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
        return [
            new DraftContent,
            new PublishContent
        ];
    }
}
