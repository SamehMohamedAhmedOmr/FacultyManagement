<?php

use Illuminate\Database\Seeder;
use App\research;

class ResearchesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\research::class, 50)->create();
    }
}
