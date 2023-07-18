<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Appearance;


class AppearanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        Appearance::firstOrCreate([
            'name' => 'cultural / religious clothing or garb',
            'code' => 'apcrcg'
        ]);
        Appearance::firstOrCreate([
            'name' => 'hair adornments and colors',
            'code' => 'aphadc'
        ]);
        Appearance::firstOrCreate([
            'name' => 'hair braids / beads / locs',
            'code' => 'aphbbl'
        ]);
        Appearance::firstOrCreate([
            'name' => 'head coverings',
            'code' => 'apheco'
        ]);
        Appearance::firstOrCreate([
            'name' => 'over weight',
            'code' => 'apovwe'
        ]);
        Appearance::firstOrCreate([
            'name' => 'short stature',
            'code' => 'apshst'
        ]);
        Appearance::firstOrCreate([
            'name' => 'tattoos / piercing',
            'code' => 'aptapi'
        ]);
    }
}
