<?php

use Illuminate\Database\Seeder;
use App\discussion;

class DiscussionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\discussion::class, 50)->create();
    }
}
