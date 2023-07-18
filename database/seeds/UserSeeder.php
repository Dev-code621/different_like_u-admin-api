<?php

namespace Database\Seeders;

use App\UserDetail;
use App\User;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

        $adminPanel = User::firstOrCreate(['email' => 'admin@yopmail.com','email_verified_at'=>'2022-12-29 11:11:29','password' => bcrypt('Password1'), 'name' => 'admin', 'last_name' => 'tim']);
        $adminPanel->assignRole('AdminPanel');

        $merchant = User::firstOrCreate(['email' => 'merchant@yopmail.com','email_verified_at'=>'2022-12-29 11:11:29','password' => bcrypt('Password1'), 'name' => 'merchant', 'last_name' => 'bob']);
        $merchant->assignRole('Merchant');

        $consumer = User::firstOrCreate(['email' => 'consumer@yopmail.com',
          'name' => 'Taylor',
          'last_name' => 'Otwell',
          'email_verified_at'=>'2022-12-29 11:11:29',
          'password' => bcrypt('Password1'),
        ]);
        $consumer->assignRole('Consumer');

  }
}
