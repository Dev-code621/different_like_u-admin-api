<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use MLL\GraphQLScalars\MixedScalar;
use Nuwave\Lighthouse\Schema\TypeRegistry;


class AppServiceProvider extends ServiceProvider
{
    protected $customHelpers = [
       'Helper',
    ];
    /**
     * Register any application services.
     */
    public function register()
    {
        foreach ($this->customHelpers as $helper) {
            require_once(app_path().'/Helpers/'.$helper.'.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        $typeRegistry = app(TypeRegistry::class);
        $typeRegistry->register(new MixedScalar());
        Collection::macro('pick', function (... $columns) {
            return $this->map(function ($item, $key) use ($columns) {
                $data = [];
                foreach ($columns as $column) {
                    $data[$column] = $item[$column] ?? null;
                }

                return $data;
            });
        });
    }
}
