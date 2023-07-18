<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Joselfonseca\LighthouseGraphQLPassport\HasLoggedInTokens;
use Joselfonseca\LighthouseGraphQLPassport\HasSocialLogin;
use Joselfonseca\LighthouseGraphQLPassport\Models\SocialProvider;
use Laravel\Passport\HasApiTokens;
use Laravel\Socialite\Facades\Socialite;
use Spatie\Permission\Traits\HasRoles;
use App\Notifications\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;
    use HasApiTokens;
    use HasLoggedInTokens;
    use HasFactory;
    use HasSocialLogin;

    protected $guard_name = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'name', 'last_name', 'email', 'password', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function byOAuthToken(Request $request)
    {
        $userData = Socialite::driver($request->get('provider'))->userFromToken($request->get('token'));
//        Log::debug(json_encode($userData));
        try {
            $user = static::whereHas('socialProviders', function ($query) use ($request, $userData) {
                $query->where('provider', Str::lower($request->get('provider')))->where('provider_id', $userData->getId());
            })->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $user = static::where('email', $userData->getEmail())->first();
            if (! $user) {
                Log::debug(json_encode([ 'name' => $userData->getName(),
                    'email' => $userData->getEmail(),
                    'uuid' => Str::uuid(),
                    'password' => Hash::make(Str::random(16)),
                    'email_verified_at' => now()]));
                $user = static::create([
                    'name' => $userData->getName() ?? $userData->getEmail(),
                    'email' => $userData->getEmail(),
                    'uuid' => Str::uuid(),
                    'password' => Hash::make(Str::random(16)),
                    'email_verified_at' => now(),
                ]);
            }
            SocialProvider::create([
                'user_id' => $user->id,
                'provider' => $request->get('provider'),
                'provider_id' => $userData->getId(),
            ]);
        }
        Auth::setUser($user);

        return $user;
    }
    public function business() {
        return $this->hasOne('App\Business');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany('App\Reviews');
    }

    public function pushNotifications()
    {
        return $this->hasMany('App\PushNotifications');
    }

    public function userDetail()
    {
        return $this->hasOne('App\UserDetail');
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification);
    }

    public function routeNotificationForFcm()
    {
        return $this->fcm_token;
    }

}
