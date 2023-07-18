<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Illuminate\Support\Str;
use App\Nova\Actions\UnpublishReview;
use App\Nova\Actions\PublishReview;
use App\Nova\Actions\BanUserReview;
use App\Nova\Actions\DismissReview;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Boolean;

class Reply extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Reply::class;

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
        'comment',
    ];

    // public static $displayInNavigation = false;

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $sort = [
        'verified' => 'asc'
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
            ID::make(__('ID'), 'id')->onlyOnForms(),
            Textarea::make(__('Review'), 'comment')->readonly()->hideFromIndex()->alwaysShow(),
            Textarea::make(__('Content'), function () {
                return Str::limit($this->comment,35);
            })->readonly()->onlyOnIndex(),
            BelongsTo::make('Replied by ', 'user', 'App\Nova\User')->exceptOnForms()->readonly(),
            Text::make(__('Reply Type'), 'type')->displayUsing(function ($type) {
                return ucwords(strtolower(str_replace('_', ' ', $type)));
            }),
            DateTime::make(__('Date'),'created_at')->format('LLL')->sortable()->readonly(),
            Text::make('Status')->exceptOnForms()->readonly()->displayUsing(function ($status) {
                if($status=="UNPUBLISHED"){
                    return ucwords(strtolower('DELETED'));
                }
                return ucwords(strtolower($status));
            }),
            Boolean::make('Verified')
                ->trueValue(1)
                ->falseValue(0)->readonly(),
            HasOne::make('Review Details', 'review', 'App\Nova\review'),
            
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
        return [
            new Filters\ContentStatus('status'),
            new Filters\ContentVerified('verified'),
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
            new PublishReview,
            new UnpublishReview,
            new BanUserReview,
            new DismissReview,
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
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];

            return $query->orderBy(key(static::$sort), reset(static::$sort));
        }

        return $query;
    }
}
