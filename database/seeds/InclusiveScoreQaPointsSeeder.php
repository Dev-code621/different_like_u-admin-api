<?php

namespace Database\Seeders;

use App\InclusiveScoreQaPoint;
use Illuminate\Database\Seeder;

class InclusiveScoreQaPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * default keys for includive_score_qa_points table
     * @return void
     */
    public function run()
    {
        InclusiveScoreQaPoint::firstOrCreate([
            'key' => 'welcomed',
            'value' => true,
            'points' => 2
        ]);
        InclusiveScoreQaPoint::firstOrCreate([
            'key' => 'respectfully',
            'value' => true,
            'points' => 2
        ]);
        InclusiveScoreQaPoint::firstOrCreate([
            'key' => 'treated_differently',
            'value' => true,
            'points' => -6
        ]);
        InclusiveScoreQaPoint::firstOrCreate([
            'key' => 'treated_differently',
            'value' => false,
            'points' => 2
        ]);
        InclusiveScoreQaPoint::firstOrCreate([
            'key' => 'recommended',
            'value' => true,
            'points' => 2
        ]);
        InclusiveScoreQaPoint::firstOrCreate([
            'key' => 'similarity',
            'value' => true,
            'points' => 2
        ]);
    }
}
