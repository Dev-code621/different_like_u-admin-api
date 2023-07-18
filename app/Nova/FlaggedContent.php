<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\DateTime;
use Carbon\Carbon;
use App\Nova\Actions\DeleteFlagged;
use App\Nova\Actions\BanUserFlagged;
use App\Nova\Actions\DismissFlagged;
use Laravel\Nova\Panel;
use App\User;

class FlaggedContent extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\FlaggedContent::class;

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
    ];

    /**
     * Default ordering for index query.
     *
     * @var array
     */
    public static $sort = [
        'status' => 'asc'
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

            BelongsTo::make('Business', 'business', 'App\Nova\Business')->readonly()->exceptOnForms(),
            Text::make('Business')->withMeta([
                'value' => $this->business->name??''
            ])->onlyOnForms()->readonly(),
            ID::make(__('ID'), 'id')->sortable()->onlyOnForms(),
            Text::make(__('Reason'), 'reason')->sortable()->readonly(),

            Select::make('Status')->options([
                'Pending' => 'Pending',
                'Resolved' => 'Resolved',
                'Dismiss' => 'Dismiss',
                'User banned' => 'User Banned',
                'Post deleted' => 'Post Deleted',
            ]),
            BelongsTo::make('Submitted by', 'user', 'App\Nova\User')->exceptOnForms(),
            Text::make('Submitted by')->withMeta([
                'value' => $this->user->name??''
            ])->onlyOnForms()->readonly(),

            Text::make('Type')->exceptOnForms()->readonly()->displayUsing(function ($type) {
                return ucwords(strtolower(str_replace('_', ' ', $type)));
            }),
            DateTime::make(__('Date'),'created_at')->format('LLL')->sortable()->readonly(),

            new Panel('Flagged Content', $this->flaggedReview()),

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
            new DeleteFlagged,
            new BanUserFlagged,
            new DismissFlagged,
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

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function flaggedReview()
    {
        $type= strtoupper(str_replace(" ","_",$this->type));

        if($type == 'MERCHANT_REPLY' || $type =='CONSUMER_REPLY'){
            return [
                 BelongsTo::make('User Name',  'reply', 'App\Nova\Reply')->readonly()->hideFromIndex()->displayUsing(function ($reply) {
                    $data = User::where('id', $reply->user_id)->firstOrFail();
                    return $data->name . ' - '.$data->email ;
                })->nullable()->viewable(false),
                BelongsTo::make('Date', 'reply', 'App\Nova\Reply')->displayUsing(function ($reply) {
                    $replyDate= Carbon::parse($reply->created_at, 'UTC');
                    return  $replyDate->isoFormat('LLL') ;
                })->readonly()->hideFromIndex(),

                BelongsTo::make('Reply', 'reply', 'App\Nova\Reply')->displayUsing(function ($reply) {
                    return $reply->comment ;
                })->readonly()->hideFromIndex(),
            ];
        }
        elseif($type =='REVIEW'){
            $reviewData = $this->review()->first(['id','user_id','comment','overall_score','created_at']);
            return [
                BelongsTo::make('User Name', 'review', 'App\Nova\Review')->readonly()->exceptOnForms()->displayUsing(function ($review) {
                    $data = User::where('id', $review->user_id)->firstOrFail();
                    return $data->name . ' - '.$data->email ;
                })->nullable()->viewable(false),
                Text::make('User Name')->withMeta([
                    'value' => ($reviewData->user->name??'') . ' - '.$reviewData->user->email
                ])->onlyOnForms()->readonly(),

                BelongsTo::make('Date', 'review', 'App\Nova\Review')->readonly()->exceptOnForms()->displayUsing(function ($review) {
                    $reviewDate= Carbon::parse($review->created_at, 'UTC');
                    return $reviewDate->isoFormat('LLL');
                })->nullable()->viewable(false),
                Text::make('Date')->withMeta([
                    'value' => Carbon::parse($reviewData->created_at, 'UTC')->isoFormat('LLL')
                ])->onlyOnForms()->readonly(),

                BelongsTo::make('Score', 'review', 'App\Nova\Review')->readonly()->exceptOnForms()->displayUsing(function ($review) {
                    return $review->overall_score;
                })->nullable()->viewable(false),
                Text::make('Score')->withMeta([
                    'value' => $reviewData->overall_score
                ])->onlyOnForms()->readonly(),

                BelongsTo::make('Review', 'review', 'App\Nova\Review')->readonly()->exceptOnForms()->displayUsing(function ($review) {
                    return $review->comment;
                })->nullable()->viewable(false),
                Text::make('Review')->withMeta([
                    'value' => $reviewData->comment
                ])->onlyOnForms()->readonly(),


            ];
        }
    }
}
