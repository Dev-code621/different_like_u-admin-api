<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;


class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'business_id',
        'comment',
        'status',
        'images',
        'overall_score',
        'inclusive_score',
        'welcomed',
        'respectfully',
        'recommended',
        'treated_differently',
        'treated_differently_reason',
        'similarity',
        'similarity_reason',
        'verified'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reply()
    {
        return $this->hasMany(Reply::class, 'review_id');
    }

    public function business(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Business::class, 'business_id');
    }
    public function flaggedContent(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FlaggedContent::class, 'review_id');
    }
    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class, 'review_id');
    }
    public function scopeEnabledReviews($query) {
        return $query->where('status', "PUBLISHED");
    }

    /**
     * get user criteria code and inclusive score
     * @param $reviews
     * @param $keys
     * @param $inclusiveScoreQaPoints
     * @return mixed
     */
    public static function getCodeNScore($reviews, $keys, $inclusiveScoreQaPoints)
    {
        $reviews->map(function ($review) use ($keys, $inclusiveScoreQaPoints) {
            $review->codes = new Collection();

            foreach ($keys as $key) {
                if (!isset($review->user->userDetail[$key])) {
                    continue;
                }
                if ($review->user->userDetail[$key] instanceof Collection) {
                    $review->codes->add($review->user->userDetail[$key]->pluck('code'));

                } else {
                    $review->codes->add($review->user->userDetail[$key]->code);
                }
            }
            //set all criteria as per user details
            $review->codes = $review->codes->flatten();
            //set total question & answer points inclusive score
            $points = 0;
            foreach ($inclusiveScoreQaPoints as $isQAPoint){
                $key = $isQAPoint->key;
                $value = $isQAPoint->value;
                if(isset($review->$key) && $review->$key == $value){
                    $points += $isQAPoint->points;
                }
            }
            /**
             * set inclusive score as per Inclusiveness Score formula
             * inclusive score = ( Points x 5 ) / 15
            */
            $review->inclusive_score = (($points+$review->inclusive_score)*5)/15;

            return $review;

        });
        return $reviews;
    }

    public function matching($rootValue, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        $consumer_id = Auth::id();
        //There is no need to match scrores if the auth user(login user) and review user are the same
        if ($consumer_id==$rootValue['user_id']){
            return '';
        }
        $consumer = UserDetail::with([
            'allyGroups',
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

        $reviewer = UserDetail::with([
            'allyGroups',
            'sexualOrientations',
            'genders',
            'race',
            'ethnicity',
            'appearance',
            'languageProficiency',
            'ageRange',
            'disabilities',
        ])
            ->where('user_id', $rootValue['user_id'])
            ->get()
            ->first();
        $acu = 0;
        //compare login user with reviewer user race
        if (isset($consumer->race_id) && isset($reviewer->race_id)) {
            $acu = $consumer->race_id === $reviewer->race_id ? $acu + 45 : $acu;
        }
        //compare login user with reviewer user ethnicity
        if (isset($consumer->ethnicity_id) && isset($reviewer->ethnicity_id)) {

            $acu = $consumer->ethnicity_id === $reviewer->ethnicity_id ? $acu + 5 : $acu;
        }
        //compare login user with reviewer user genders
        if (isset($consumer->genders) && isset($reviewer->genders)) {

            /*$consumerIds = $consumer->genders->map(function ($gender) {
                return $gender->id;
            });

            $reviewerIds = $reviewer->genders->map(function ($gender) {
                return $gender->id;
            });

            if (is_array($consumerIds) && is_array($reviewerIds)) {
                $acu = in_array($consumerIds, $reviewerIds) ? $acu + 15 : $acu;
            }*/
            //get gender id from login user and reviewer user
            $consumerIds = $consumer->genders->pluck('id');
            $reviewerIds = $reviewer->genders->pluck('id');
            //merge both gender id from login user and reviewer user And get duplicates gender id
            $duplicateIds = $consumerIds->merge($reviewerIds)->duplicates();
            //if any id found for both login user and reviewer then, they get full 15 points
            if ($duplicateIds->count()){
                $acu = $acu + 15;
            }
        }
        //compare login user with reviewer user disabilities
        if (isset($consumer->disabilities) && isset($reviewer->disabilities)) {

            /*$consumerIds = $consumer->disabilities->map(function ($gender) {
                return $gender->id;
            });

            $reviewerIds = $reviewer->disabilities->map(function ($gender) {
                return $gender->id;
            });

            if (is_array($consumerIds) && is_array($reviewerIds)) {
                $acu = in_array($consumerIds, $reviewerIds) ? $acu + 12 : $acu;
            }*/
            //get disabilities id from login user and reviewer user
            $consumerIds = $consumer->disabilities->pluck('id');
            $reviewerIds = $reviewer->disabilities->pluck('id');

            //if both login user and reviewer user have any disabilities then, they get full 12 points
            if ($consumerIds->count() && $reviewerIds->count()){
                $acu = $acu + 12;
            }
        }
        //compare login user with reviewer user sexual orientations
        //if (isset($consumer->sexual_orientations) && isset($reviewer->sexual_orientations)) {
        if (isset($consumer->sexualOrientations) && isset($reviewer->sexualOrientations)) {

            /*$consumerIds = $consumer->sexual_orientations->map(function ($gender) {
                return $gender->id;
            });

            $reviewerIds = $reviewer->sexual_orientations->map(function ($gender) {
                return $gender->id;
            });

            if (is_array($consumerIds) && is_array($reviewerIds)) {
                $acu = in_array($consumerIds, $reviewerIds) ? $acu + 23 : $acu;
            }*/
            //get sexual_orientations id from login user and reviewer user
            $consumerIds = $consumer->sexualOrientations->pluck('id');
            $reviewerIds = $reviewer->sexualOrientations->pluck('id');
            //merge both sexual Orientations id from login user and reviewer user And get duplicates sexual Orientations id
            $duplicateIds = $consumerIds->merge($reviewerIds)->duplicates();
            //if any id found for both login user and reviewer then, they get full 23 points
            if ($duplicateIds->count()){
                $acu = $acu + 23;
            }
        }

        if ($acu >= 70) {
            return 'Perfect match';
        } else if ($acu >= 48 && $acu <= 69) {
            return 'Great match';
        } else {
            return 'Good match';
        }
    }
}
