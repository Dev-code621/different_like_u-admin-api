<?php

namespace Database\Seeders;

use App\SexualOrientation;
use Illuminate\Database\Seeder;

class SexualOrientationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SexualOrientation::firstOrCreate([
            'name' => 'bisexual',
            'code' => 'sobise'
        ]);
        SexualOrientation::firstOrCreate([
            'name' => 'gay',
            'code' => 'sogay'
        ]);
        SexualOrientation::firstOrCreate([
            'name' => 'heterosexual',
            'code' => 'sohete'
        ]);
        SexualOrientation::firstOrCreate([
            'name' => 'lesbian',
            'code' => 'solesb'
        ]);
        SexualOrientation::firstOrCreate([
            'name' => 'queer',
            'code' => 'soquee'
        ]);
        SexualOrientation::firstOrCreate([
            'name' => 'prefer not to say',
            'code' => 'sopnts'
        ]);

    }
}
