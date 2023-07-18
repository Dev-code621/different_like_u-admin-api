<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\AllyGroup;


class AllyGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AllyGroup::firstOrCreate([
            'name' => 'alaskan native',
            'code' => 'agalna'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'asian',
            'code' => 'agasia'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'black',
            'code' => 'agblac'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'hispanic/latino',
            'code' => 'aghila'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'indian',
            'code' => 'agindi'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'indigenous american',
            'code' => 'aginam'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'lgbtq',
            'code' => 'aglgbt'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'man',
            'code' => 'agman'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'middle eastern',
            'code' => 'agmiea'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'non-binary',
            'code' => 'agnobi'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'north african',
            'code' => 'agnoaf'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'over 40',
            'code' => 'agover'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'pacific islander',
            'code' => 'agpais'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'persons with disabilities',
            'code' => 'agpwdi'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'two or more',
            'code' => 'agtwmo'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'white',
            'code' => 'agwhit'
        ]);
        AllyGroup::firstOrCreate([
            'name' => 'women',
            'code' => 'agwome'
        ]);
    }
}
