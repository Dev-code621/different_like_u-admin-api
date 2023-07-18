<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\IncomeRange;


class IncomeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IncomeRange::firstOrCreate([
            'name' => 'none',
            'code' => 'irnone'
        ]);
        IncomeRange::firstOrCreate([
            'name' => 'under $15k',
            'code' => 'irtwo'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$16k - $45k',
            'code' => 'irthre'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$46k - $70k',
            'code' => 'irfour'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$71K - $95K',
            'code' => 'irfive'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$96K - $150K',
            'code' => 'irsix'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$151K - $200K',
            'code' => 'irseve'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$201K - $350K',
            'code' => 'ireight'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$351K - $500K',
            'code' => 'irnine'
        ]);
        IncomeRange::firstOrCreate([
            'name' => '$501K+',
            'code' => 'irten'
        ]);

    }
}
