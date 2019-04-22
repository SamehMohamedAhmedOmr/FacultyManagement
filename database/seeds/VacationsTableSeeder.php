<?php

use Illuminate\Database\Seeder;
use App\vacation;

class VacationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\vacation::class, 50)->create();
    }
}
