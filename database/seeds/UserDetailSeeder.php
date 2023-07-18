<?php

namespace Database\Seeders;

use App\UserDetail;
use Illuminate\Database\Seeder;

class UserDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserDetail::factory()
          ->count(20)
          ->create();
    }
}
