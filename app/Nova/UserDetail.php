<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Nova\Fields\Text;
use OptimistDigital\MultiselectField\Multiselect;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserDetail extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\UserDetail::class;

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
            ID::make(__('ID'), 'id')->sortable(),

            Multiselect::make('gender')
                ->options([
                    'MALE' => 'Male',
                    'FEMALE' => 'Female',
                    'TRANSGENDER' => 'Transgender',
                    'NON_BINARY' => 'Non-Binary',
                ])
                ->placeholder('Choose your gender')
                ->max(2)
                ->indexDelimiter(', ')
                ->clearOnSelect()
                ->optionsLimit(5),

                Multiselect::make('sexual_orientation')
                    ->options([
                        'BISEXUAL' => 'Bisexual',
                        'GAY' => 'Gay',
                        'HETEROSEXUAL' => 'Heterosexual',
                        'LESBIAN' => 'Lesbian',
                        'QUEER' => 'Queer',
                        'PREFER_NOT_TO_SAY' => 'Prefer not to say',

                    ])
                    ->placeholder('Choose your sexual orientation')
                    ->max(2)
                    ->indexDelimiter(', ')
                    ->clearOnSelect()
                    ->optionsLimit(5),

                Multiselect::make('race')
                    ->options([
                        'ASIAN' => 'Asian',
                        'ALASKAN_NATIVE' => 'Alaskan Native',
                        'BLACK' => 'Black',
                        'INDIAN' => 'Indian',
                        'INDIGENOUS_AMERICAN' => 'Indigenous American',
                        'NORTH_AFRICAN' => 'North African',
                        'MIDDLE_EASTERN' => 'Middle Eastern',
                        'PACIFIC_ISLANDER' => 'Pacific Islander',
                        'WHITE' => 'White',
                        'TWO_OR_MORE' => 'Two or more',


                    ])
                    ->placeholder('Choose your race')
                    ->max(2)
                    ->indexDelimiter(', ')
                    ->clearOnSelect()
                    ->optionsLimit(5),


                    Multiselect::make('ally_groups')
                        ->options([
                            'ASIAN' => 'Asian',
                            'ALASKAN_NATIVE' => 'Alaskan Native',
                            'BLACK' => 'Black',
                            'LGBTQ' => 'lgbtq',
                            'HISPANIC' => 'Hispanic/Latino',
                            'INDIAN' => 'Indian',
                            'INDIGENOUS_AMERICAN' => 'Indigenous American',
                            'NORTH_AFRICAN' => 'North African',
                            'NON_BINARY' => 'Non-Binary',
                            'MAN' => 'Man',
                            'MIDDLE_EASTERN' => 'Middle Eastern',
                            'PACIFIC_ISLANDER' => 'Pacific Islander',
                            'PERSONS_WITH_DISABILITIES' => 'Persons with Disabilities',
                            'WHITE' => 'White',
                            'WOMAN' => 'Woman',
                            'TWO_OR_MORE' => 'Two or more',
                        ])
                        ->placeholder('Choose your Ally Groups')
                        ->max(3)
                        ->indexDelimiter(', ')
                        ->clearOnSelect()
                        ->optionsLimit(5),
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
}
