<?php

use App\Nova\Business;
use Database\Seeders\InclusiveScoreQaPointsSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AgeRangeSeeder;
use Database\Seeders\AllyGroupSeeder;
use Database\Seeders\AppearanceSeeder;
use Database\Seeders\DisabilitySeeder;
use Database\Seeders\EthnicitySeeder;
use Database\Seeders\GenderSeeder;
use Database\Seeders\IncomeRangeSeeder;
use Database\Seeders\LanguageProficiencySeeder;
use Database\Seeders\RaceSeeder;
use Database\Seeders\SexualOrientationSeeder;
use Database\Seeders\PreferencesSeeder;
use Database\Seeders\ReviewSeeder;
use Database\Seeders\BusinessSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            AgeRangeSeeder::class,
            AllyGroupSeeder::class,
            AppearanceSeeder::class,
            DisabilitySeeder::class,
            EthnicitySeeder::class,
            GenderSeeder::class,
            IncomeRangeSeeder::class,
            LanguageProficiencySeeder::class,
            RaceSeeder::class,
            SexualOrientationSeeder::class,
            PreferencesSeeder::class,
            InclusiveScoreQaPointsSeeder::class,
        ]);
    }
}
