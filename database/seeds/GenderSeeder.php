<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Gender;


class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gender::firstOrCreate([
            'name' => 'male',
            'code' => 'gemale'
        ]);
        Gender::firstOrCreate([
            'name' => 'female',
            'code' => 'gefema'
        ]);
        Gender::firstOrCreate([
            'name' => 'transgender',
            'code' => 'getrgd'
        ]);
        Gender::firstOrCreate([
            'name' => 'non-binary',
            'code' => 'genobi'
        ]);

    }
}
