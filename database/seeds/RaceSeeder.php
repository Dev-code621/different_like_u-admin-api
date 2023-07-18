<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Race;


class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Race::firstOrCreate([
            'name' => 'alaskan native',
            'code' => 'rcalna'
        ]);
        Race::firstOrCreate([
            'name' => 'asian',
            'code' => 'rcasia'
        ]);
        Race::firstOrCreate([
            'name' => 'black',
            'code' => 'rcblac'
        ]);
        Race::firstOrCreate([
            'name' => 'indian',
            'code' => 'rcindi'
        ]);
        Race::firstOrCreate([
            'name' => 'indigenous american',
            'code' => 'rcinam'
        ]);
        Race::firstOrCreate([
            'name' => 'middle eastern',
            'code' => 'rcmiea'
        ]);
        Race::firstOrCreate([
            'name' => 'north african',
            'code' => 'rcnoaf'
        ]);
        Race::firstOrCreate([
            'name' => 'pacific islander',
            'code' => 'rcpais'
        ]);
        Race::firstOrCreate([
            'name' => 'two or more',
            'code' => 'rctwmo'
        ]);
        Race::firstOrCreate([
            'name' => 'white',
            'code' => 'rcwhit'
        ]);

    }
}
