<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\DateTime;
use App\Nova\Actions\DraftContent;
use App\Nova\Actions\PublishContent;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Heading;

class EducationalContent extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\EducationalContent::class;

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
        'description'
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
        return __('Sacki Says');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return __('Sacki Says');
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
            Heading::make('<h5>This is snackable content that lives under the "Did You Know?" section of the consumer mobile app.</h5>')
            ->asHtml(),
            ID::make(__('ID'), 'id')->sortable()->hideFromIndex(),
            Text::make(__('Resource Name'),'name')->rules('required')->placeholder('Name')->help(' This name is the internal content name. It is not consumer facing, but just used to make navigating content easier for admins.'),
            Text::make('Status')->exceptOnForms()->displayUsing(function ($status) {
                return ucwords(strtolower(str_replace('_', ' ', $status)));
            }),
            Textarea::make(__('Description'),'description')->rules('required')->placeholder('Summary')->help('A summary of the training resource that will appear on users home page (“Did you know?” block). Make it upto 140 characters.')->alwaysShow()->withMeta(['extraAttributes' => ['maxlength' => 140]]),
            Text::make(__('Description'), function () {
                return Str::limit($this->description,30);
            })->onlyOnIndex(),
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
