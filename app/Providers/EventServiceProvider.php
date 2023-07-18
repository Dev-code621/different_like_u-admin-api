<?php

namespace App\Providers;

use App\Like;
use App\Observers\ClientObserver;
use App\Observers\LikeObserver;
use App\Observers\ReplyObserver;
use App\Observers\UserObserver;
use App\Reply;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Laravel\Passport\Client;
use App\Observers\ReviewObserver;
use App\Review;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            \SocialiteProviders\Apple\AppleExtendSocialite::class.'@handle',
        ],
        'Illuminate\Notifications\Events\NotificationSent' => [
            'App\Listeners\NotificationListener',
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();
        User::observe(new UserObserver());
        Reply::observe(new ReplyObserver());
        Like::observe(new LikeObserver());
        Client::observe(new ClientObserver());
        Review::observe(new ReviewObserver());
    }
}
