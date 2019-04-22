<?php

use Illuminate\Database\Seeder;

use App\discussion;
use App\facultyMembers;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            VacationsTableSeeder::class,
            ResearchesTableSeeder::class,
            DiscussionsTableSeeder::class,
        ]);

        // Get all the roles attaching up to 3 random roles to each user
        $members = App\facultyMembers::all();
        // Populate the pivot table$member
        App\discussion::all()->each(function ($discussion) use ($members) {
            $discussion->supervised()->attach(
                $members->random(3)->pluck('id')->toArray()
            );
        });
    }
}
