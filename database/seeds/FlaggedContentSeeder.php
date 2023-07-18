<?php

namespace Database\Seeders;

use App\FlaggedContent;
use Illuminate\Database\Seeder;

class FlaggedContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         FlaggedContent::factory()->firstOrCreate();

    }
}
