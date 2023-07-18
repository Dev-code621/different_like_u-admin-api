<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\DateTime;
// use Laravel\Nova\Fields\Status;
use App\Nova\Actions\DraftContent;
use App\Nova\Actions\PublishContent;
use Laravel\Nova\Fields\Image;
use Illuminate\Support\Facades\Storage;
use Helper;

class Post extends Resource
{

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Post::class;

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
        'title'
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
        return __('Blog Posts');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Blog Post');
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
            Text::make(__('Blog Post'),'title')->placeholder('My New Post')->rules('required'),
            Text::make('Status')->exceptOnForms()->displayUsing(function ($status) {
                return ucwords(strtolower(str_replace('_', ' ', $status)));
            }),
            // Select::make('Status')->displayUsingLabels()->onlyOnIndex(),
            Select::make(__('Category'),'category')->options([
                'UNCONSCIOUS_BIAS' => 'Unconscious Bias',
                'INCLUSIVE_COMMUNICATION_AND_MARKETING' => 'Inclusive Comunication & Marketing',
                'ANTI_DISCRIMINATION_RESOURCES' => 'Anti-Discrimination Resources',
                'DIVERSE_AND_INCLUSIVE_TEAMS' => 'Diverse and Inclusive Teams',
                'CONSUMER_TRENDS' => 'Consumer Trends',
                'MAXIMIZING_YOUR_DATA' => 'Maximizing Your Data',
            ])->placeholder('Select a category')->rules('required')->onlyOnForms(),
            Text::make('Category')->exceptOnForms()->displayUsing(function ($category) {
                return ucwords(strtolower(str_replace('_', ' ', $category)));
            }),
            BelongsTo::make('Author', 'user', 'App\Nova\Admin')->hideFromIndex(),
            Textarea::make(__('Summary'),'summary')->placeholder('Summary')->rules('required')->hideFromIndex()->help('A summary of the blog post that will appear on the blog posts grids (Merchant’s Dashboard & Resources). Make it upto 140 characters.')->alwaysShow()->withMeta(['extraAttributes' => ['maxlength' => 140]]),
            Trix::make(__('Body'),'content')->placeholder('Post')->rules('required')->hideFromIndex()->alwaysShow()->withFiles('s3'),

            Image::make(__('Main/Cover image'),'image')->disk('s3')
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
