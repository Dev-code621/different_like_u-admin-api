<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\LanguageProficiency;


class LanguageProficiencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LanguageProficiency::firstOrCreate([
            'name' => 'beginner',
            'code' => 'lpbegi'
        ]);
        LanguageProficiency::firstOrCreate([
            'name' => 'intermediate',
            'code' => 'lpinte'
        ]);
        LanguageProficiency::firstOrCreate([
            'name' => 'native / multilingual',
            'code' => 'lpnamu'
        ]);
    }
}
