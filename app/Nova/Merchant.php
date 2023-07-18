<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Fields\Avatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\Actions\ResetPassword;
use App\Nova\Actions\Ban;
use App\Nova\Actions\Unban;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasOne;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use App\Business;
use Helper;

class Merchant extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    // public static $title = 'name';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        return $this->name .' '. $this->last_name;
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'businesses.name',
        'name',
        'last_name',
        'email'
    ];

    /**
     * Custom priority level of the resource.
     *
     * @var int
     */
    public static $priority = 2;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = '1.Users Admin';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable()->hideFromIndex(),

            HasOne::make('Business Details', 'business', 'App\Nova\Business'),

            Text::make('Business Name','business_name')
                ->readonly()
                ->onlyOnIndex(),

            Text::make('Email')
                ->onlyOnIndex(),

            Text::make(__('Address'), function () {
                return Str::limit($this->default_address,30);
            })->onlyOnIndex(),

            Text::make('Status')->exceptOnForms()->readonly()->displayUsing(function ($status) {
                return ucwords(strtolower(str_replace('_', ' ', $status)));
            }),
            DateTime::make(__('Claimed'), function () {
                    return $this->claimed_on;
            })->format('LLL')->sortable()->onlyOnIndex(),

            // form
            Avatar::make('Avatar')->disk('s3')->hideFromIndex()->preview(function($value, $disk) {
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

            Text::make('First Name','name')
                ->sortable()
                ->rules('required', 'max:100')
                ->hideFromIndex(),

            Text::make('Last Name','last_name')
                ->sortable()
                ->rules('required', 'max:100')
                ->hideFromIndex(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}')->hideFromIndex(),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', 'string', \Illuminate\Validation\Rules\Password::min(6)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised())
                ->updateRules('nullable', 'string', \Illuminate\Validation\Rules\Password::min(6)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised()),

            DateTime::make(__('Joined'),'created_at')->format('LLL')->sortable()->onlyOnDetail(),
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
            (new ResetPassword())->showOnTableRow(),
            (new Ban())->showOnTableRow(),
            (new Unban())->showOnTableRow(),
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
        return $query
            ->select(
                'users.id as id',
                'users.name as name',
                'users.email as email',
                'users.status as status',
                'businesses.name as business_name',
                'businesses.links as link',
                'businesses.other_link as other_link',
                'businesses.created_at as created_at',
                'businesses.claimed_on as claimed_on',
                'businesses.default_address as default_address')
            ->leftJoin('businesses', 'businesses.user_id', '=', 'users.id')
            // ->leftJoin('google_places', 'google_places.place_id', '=', 'businesses.google_id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('roles.name', '=', 'Merchant');
    }
}
