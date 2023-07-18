<?php

namespace App;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class Business extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'google_id',
        'name',
        'about',
        'image',
        'links',
        'other_link',
        'user_id',
        'claimed',
        'default_address',
        'types',
        'international_phone_number',
        'latitude',
        'longitude',
        'url',
        'website',
        'claimed_on',
        'email_notification',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function businessProof(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasMany(BusinessProof::class, 'business_id', 'id');
    }

    public function reviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Review::class, 'business_id', 'id');
    }

    public function scoring(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->HasMany(Scoring::class, 'business_id');
    }

    public function flaggedContent(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FlaggedContent::class, 'id', 'business_id');
    }

    public function forYouScore($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $consumer_id = Auth::id();
        $consumer = UserDetail::with([
            'sexualOrientations',
            'genders',
            'race',
            'ethnicity',
            'appearance',
            'languageProficiency',
            'ageRange',
            'disabilities',
        ])
            ->where('user_id', $consumer_id)
            ->get()
            ->first();
        $keys = [
            'sexualOrientations',
            'genders',
            'race',
            'ethnicity',
            'appearance',
            'languageProficiency',
            'ageRange',
            'disabilities',
        ];
        $business = Business::where('google_id', $rootValue->google_id)->get()
            ->first();
        $codes = new Collection();
        foreach ($keys as $key) {
            if (!isset($consumer[$key])) {
                continue;
            }
            if ($consumer[$key] instanceof Collection) {
                $codes->add($consumer[$key]->pluck('code'));

            } else {
                $codes->add($consumer[$key]->code);
            }
        }
        $codes = $codes->flatten();
        $scores = $business->scoring()
            ->select()
            ->whereIn('code', $codes)
            ->get();
        return $scores->avg('score');
    }

    public function allyGroupScores($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $consumer_id = Auth::id();
        $consumer = UserDetail::with([
            'allyGroups',
        ])
            ->where('user_id', $consumer_id)
            ->get()
            ->first();
        $keys = [
            'allyGroups',
        ];
        $business = Business::where('google_id', $rootValue->google_id)->get()
            ->first();
        $codes = new Collection();
        if (isset($consumer['allyGroups'])) {
            if ($consumer['allyGroups'] instanceof Collection) {
                $codes->add($consumer['allyGroups']->pluck('code'));
            } else {
                $codes->add($consumer['allyGroups']->code);
            }
        }
        $codes = $codes->flatten();
        $scores = $business->scoring()
            ->select()
            ->whereIn('code', $codes)
            ->get();
        $allyScoresArray = array();
        foreach ($scores as &$score) {
            array_push($allyScoresArray, (object)[
                'score' => $score->score,
                'name' => AllyGroup::where('code', $score->code)->first()->name,
            ]);
        }
        return $allyScoresArray;
    }
}
