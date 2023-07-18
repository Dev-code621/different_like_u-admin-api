<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;


class BusinessesScores extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:scores';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'it calculates the score for all businesses';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /*$reviewsByBusiness = Review::with([
            'user.userDetail',
            'user.userDetail.allyGroups',
            'user.userDetail.sexualOrientations',
            'user.userDetail.genders',
            'user.userDetail.race',
            'user.userDetail.ethnicity',
            'user.userDetail.appearance',
            'user.userDetail.languageProficiency',
            'user.userDetail.ageRange',
            'user.userDetail.disabilities',
        ])
            ->get()
            ->groupBy('business_id');

        $keys = [
            'allyGroups',
            'sexualOrientations',
            'genders',
            'race',
            'ethnicity',
            'appearance',
            'languageProficiency',
            'ageRange',
            'disabilities',
        ];

        $preferences = Preference::all();
        $start = now();
        $this->comment('Processing');
        $reviewsByBusiness->map(function ($reviews, $business_id) use ($keys, $preferences) {
            $reviews->map(function ($review) use ($keys, $preferences) {
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

                $review->codes = $review->codes->flatten();
                return $review;

            });
            $this->comment($reviews->avg('inclusive_score'));
            Business::where('id', $business_id)->update(['avg_inclusive_score' => $reviews->avg('inclusive_score')]);

            foreach ($preferences as $preference) {

                $filtered = $reviews->filter(function ($review, $key) use ($preference) {
                    return $review->codes->contains($preference->code);
                });
                if ($filtered->isNotEmpty()) {
                    $scoring = Scoring::firstOrNew(['business_id' => $business_id, 'code' => $preference->code]);
                    $scoring->business_id = $business_id;
                    $scoring->code = $preference->code;
                    $scoring->score = $filtered->avg('inclusive_score');
                    $scoring->save();
                }
            }
        });
        $time = $start->diffInSeconds(now());
        $this->comment("Processed in $time seconds");
        Log::info('Business Scores has been executed at: ' . Carbon::now());*/
        $start = now();
        $this->comment('Processing');
        Helper::setBusinessScores();
        $time = $start->diffInSeconds(now());
        $this->comment("Processed in $time seconds");
        Log::info('Business Scores has been executed at: ' . Carbon::now());
    }
}
