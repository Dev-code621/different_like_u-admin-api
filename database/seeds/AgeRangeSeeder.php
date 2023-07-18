<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\AgeRange;


class AgeRangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AgeRange::firstOrCreate([
            'name' => '13 - 17',
            'code' => 'arone'
        ]);
        AgeRange::firstOrCreate([
            'name' => '18 - 25',
            'code' => 'artwo'
        ]);
        AgeRange::firstOrCreate([
            'name' => '26 - 33',
            'code' => 'arthre'
        ]);
        AgeRange::firstOrCreate([
            'name' => '34 - 41',
            'code' => 'arfour'
        ]);
        AgeRange::firstOrCreate([
            'name' => '42 - 48',
            'code' => 'arfive'
        ]);
        AgeRange::firstOrCreate([
            'name' => '49 - 56',
            'code' => 'arsix'
        ]);
        AgeRange::firstOrCreate([
            'name' => '57 - 64',
            'code' => 'arseve'
        ]);
        AgeRange::firstOrCreate([
            'name' => '65+',
            'code' => 'areight'
        ]);
    }
}
