<?php

namespace Database\Seeders;

use App\Preference;
use Illuminate\Database\Seeder;


class PreferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Preference::firstOrCreate([
            'name' => '13 - 17',
            'code' => 'arone'
        ]);
        Preference::firstOrCreate([
            'name' => '18 - 25',
            'code' => 'artwo'
        ]);
        Preference::firstOrCreate([
            'name' => '26 - 33',
            'code' => 'arthre'
        ]);
        Preference::firstOrCreate([
            'name' => '34 - 41',
            'code' => 'arfour'
        ]);
        Preference::firstOrCreate([
            'name' => '42 - 48',
            'code' => 'arfive'
        ]);
        Preference::firstOrCreate([
            'name' => '49 - 56',
            'code' => 'arsix'
        ]);
        Preference::firstOrCreate([
            'name' => '57 - 64',
            'code' => 'arseve'
        ]);
        Preference::firstOrCreate([
            'name' => '65+',
            'code' => 'areight'
        ]);

        Preference::firstOrCreate([
            'name' => 'alaskan native',
            'code' => 'agalna'
        ]);
        Preference::firstOrCreate([
            'name' => 'asian',
            'code' => 'agasia'
        ]);
        Preference::firstOrCreate([
            'name' => 'black',
            'code' => 'agblac'
        ]);
        Preference::firstOrCreate([
            'name' => 'hispanic/latino',
            'code' => 'aghila'
        ]);
        Preference::firstOrCreate([
            'name' => 'indian',
            'code' => 'agindi'
        ]);
        Preference::firstOrCreate([
            'name' => 'indigenous american',
            'code' => 'aginam'
        ]);
        Preference::firstOrCreate([
            'name' => 'lgbtq',
            'code' => 'aglgbt'
        ]);
        Preference::firstOrCreate([
            'name' => 'man',
            'code' => 'agman'
        ]);
        Preference::firstOrCreate([
            'name' => 'middle eastern',
            'code' => 'agmiea'
        ]);
        Preference::firstOrCreate([
            'name' => 'non-binary',
            'code' => 'agnobi'
        ]);
        Preference::firstOrCreate([
            'name' => 'north african',
            'code' => 'agnoaf'
        ]);
        Preference::firstOrCreate([
            'name' => 'over 40',
            'code' => 'agover'
        ]);
        Preference::firstOrCreate([
            'name' => 'pacific islander',
            'code' => 'agpais'
        ]);
        Preference::firstOrCreate([
            'name' => 'persons with disabilities',
            'code' => 'agpwdi'
        ]);
        Preference::firstOrCreate([
            'name' => 'two or more',
            'code' => 'agtwmo'
        ]);
        Preference::firstOrCreate([
            'name' => 'white',
            'code' => 'agwhit'
        ]);
        Preference::firstOrCreate([
            'name' => 'women',
            'code' => 'agwome'
        ]);

        Preference::firstOrCreate([
            'name' => 'cultural / religious clothing or garb',
            'code' => 'apcrcg'
        ]);
        Preference::firstOrCreate([
            'name' => 'hair adornments and colors',
            'code' => 'aphadc'
        ]);
        Preference::firstOrCreate([
            'name' => 'hair braids / beads / locs',
            'code' => 'aphbbl'
        ]);
        Preference::firstOrCreate([
            'name' => 'head coverings',
            'code' => 'apheco'
        ]);
        Preference::firstOrCreate([
            'name' => 'over weight',
            'code' => 'apovwe'
        ]);
        Preference::firstOrCreate([
            'name' => 'short stature',
            'code' => 'apshst'
        ]);
        Preference::firstOrCreate([
            'name' => 'tattoos / piercing',
            'code' => 'aptapi'
        ]);

        Preference::firstOrCreate([
            'name' => 'cognitive Preference',
            'code' => 'dicodi'
        ]);
        Preference::firstOrCreate([
            'name' => 'emotional Preference',
            'code' => 'diemdi'
        ]);
        Preference::firstOrCreate([
            'name' => 'health conditions',
            'code' => 'diheco'
        ]);
        Preference::firstOrCreate([
            'name' => 'hearing impairment',
            'code' => 'diheim'
        ]);
        Preference::firstOrCreate([
            'name' => 'mental health Preference',
            'code' => 'dimgdi'
        ]);
        Preference::firstOrCreate([
            'name' => 'mobility / physical Preference',
            'code' => 'dimoph'
        ]);
        Preference::firstOrCreate([
            'name' => 'speech / communication Preference',
            'code' => 'discod'
        ]);
        Preference::firstOrCreate([
            'name' => 'visual impairment',
            'code' => 'divimp'
        ]);

        Preference::firstOrCreate([
            'name' => 'hispnic / latino',
            'code' => 'ethila'
        ]);
        Preference::firstOrCreate([
            'name' => 'non hispanic / latino',
            'code' => 'etnohl'
        ]);

        Preference::firstOrCreate([
            'name' => 'male',
            'code' => 'gemale'
        ]);
        Preference::firstOrCreate([
            'name' => 'female',
            'code' => 'gefema'
        ]);
        Preference::firstOrCreate([
            'name' => 'transPreference',
            'code' => 'getrgd'
        ]);
        Preference::firstOrCreate([
            'name' => 'non-binary',
            'code' => 'genobi'
        ]);
        Preference::firstOrCreate([
            'name' => 'none',
            'code' => 'irnone'
        ]);
        Preference::firstOrCreate([
            'name' => 'under $15k',
            'code' => 'irtwo'
        ]);
        Preference::firstOrCreate([
            'name' => '$16k - $45k',
            'code' => 'irthre'
        ]);
        Preference::firstOrCreate([
            'name' => '$46k - $70k',
            'code' => 'irfour'
        ]);
        Preference::firstOrCreate([
            'name' => '$71K - $95K',
            'code' => 'irfive'
        ]);
        Preference::firstOrCreate([
            'name' => '$96K - $150K',
            'code' => 'irsix'
        ]);
        Preference::firstOrCreate([
            'name' => '$151K - $200K',
            'code' => 'irseve'
        ]);
        Preference::firstOrCreate([
            'name' => '$201K - $350K',
            'code' => 'ireight'
        ]);
        Preference::firstOrCreate([
            'name' => '$351K - $500K',
            'code' => 'irnine'
        ]);
        Preference::firstOrCreate([
            'name' => '$501K+',
            'code' => 'irten'
        ]);

        Preference::firstOrCreate([
            'name' => 'beginner',
            'code' => 'lpbegi'
        ]);
        Preference::firstOrCreate([
            'name' => 'intermediate',
            'code' => 'lpinte'
        ]);
        Preference::firstOrCreate([
            'name' => 'native / multilingual',
            'code' => 'lpnamu'
        ]);

        Preference::firstOrCreate([
            'name' => 'alaskan native',
            'code' => 'rcalna'
        ]);
        Preference::firstOrCreate([
            'name' => 'asian',
            'code' => 'rcasia'
        ]);
        Preference::firstOrCreate([
            'name' => 'black',
            'code' => 'rcblac'
        ]);
        Preference::firstOrCreate([
            'name' => 'indian',
            'code' => 'rcindi'
        ]);
        Preference::firstOrCreate([
            'name' => 'indigenous american',
            'code' => 'rcinam'
        ]);
        Preference::firstOrCreate([
            'name' => 'middle eastern',
            'code' => 'rcmiea'
        ]);
        Preference::firstOrCreate([
            'name' => 'north african',
            'code' => 'rcnoaf'
        ]);
        Preference::firstOrCreate([
            'name' => 'pacific islander',
            'code' => 'rcpais'
        ]);
        Preference::firstOrCreate([
            'name' => 'two or more',
            'code' => 'rctwmo'
        ]);
        Preference::firstOrCreate([
            'name' => 'white',
            'code' => 'rcwhit'
        ]);

        Preference::firstOrCreate([
            'name' => 'bisexual',
            'code' => 'sobise'
        ]);
        Preference::firstOrCreate([
            'name' => 'gay',
            'code' => 'sogay'
        ]);
        Preference::firstOrCreate([
            'name' => 'heterosexual',
            'code' => 'sohete'
        ]);
        Preference::firstOrCreate([
            'name' => 'lesbian',
            'code' => 'solesb'
        ]);
        Preference::firstOrCreate([
            'name' => 'queer',
            'code' => 'soquee'
        ]);
        Preference::firstOrCreate([
            'name' => 'prefer not to say',
            'code' => 'sopnts'
        ]);

    }
}
