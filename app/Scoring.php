<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scoring extends Model
{

    protected $table = 'scoring';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'code',
        'score'
    ];

    public function business(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->HasMany(Business::class, 'business_id');
    }

    /**
     * add or update criteria wise scores
     * @param $reviews
     * @param $preferences
     */
    public static function addUpdateScore($reviews, $preferences)
    {
        $businessId = $reviews[0]->business_id;
        $preferences->map(function ($preference) use ($businessId, $reviews) {
            $filtered = $reviews->filter(function ($review, $key) use ($preference) {
                return $review->codes->contains($preference->code);
            });
            if ($filtered->isNotEmpty()) {
                $scoring = self::firstOrNew(['business_id' => $businessId, 'code' => $preference->code]);
                $scoring->business_id = $businessId;
                $scoring->code = $preference->code;
                $scoring->score = $filtered->avg('inclusive_score');
                $scoring->save();
            }
        });
    }
}
