<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Disability;


class DisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disability::firstOrCreate([
            'name' => 'cognitive disability',
            'code' => 'dicodi'
        ]);
        Disability::firstOrCreate([
            'name' => 'emotional disability',
            'code' => 'diemdi'
        ]);
        Disability::firstOrCreate([
            'name' => 'health conditions',
            'code' => 'diheco'
        ]);
        Disability::firstOrCreate([
            'name' => 'hearing impairment',
            'code' => 'diheim'
        ]);
        Disability::firstOrCreate([
            'name' => 'mental health disability',
            'code' => 'dimgdi'
        ]);
        Disability::firstOrCreate([
            'name' => 'mobility / physical disability',
            'code' => 'dimoph'
        ]);
        Disability::firstOrCreate([
            'name' => 'speech / communication disability',
            'code' => 'discod'
        ]);
        Disability::firstOrCreate([
            'name' => 'visual impairment',
            'code' => 'divimp'
        ]);

    }
}
