<?php

namespace App\Console\Commands;

use App\Business;
use App\UserDetail;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class TestForYouScore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calculate:foryou';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $consumer_id = 3;
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
        $business = Business::where('google_id', 'jdjd')->get()
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
            ->whereIn('code',$codes)
            ->get();

        $this->comment($scores->avg('score'));
    }
}
