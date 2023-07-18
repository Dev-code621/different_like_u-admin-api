<?php

namespace Database\Seeders;

use App\Business;
use App\User;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->firstOrCreate();
        $business = Business::factory()
            ->for($user)
            ->firstOrCreate();
//        $places = GooglePlaces::factory()
//            ->count(1)
//            ->firstOrCreate([
//                'place_id' => $business->google_id,
//            ]);


//        $merchants = User::factory()->count(6)->firstOrCreate();
    }
}
