<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Ethnicity;


class EthnicitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ethnicity::firstOrCreate([
            'name' => 'hispanic / latino',
            'code' => 'ethila'
        ]);
        Ethnicity::firstOrCreate([
            'name' => 'non hispanic / latino',
            'code' => 'etnohl'
        ]);
    }
}
