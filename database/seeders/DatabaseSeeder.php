<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$posts = factory(App\Models\Project::class, 100) -> create();

        \App\Models\Project::factory(200)->create();
        \App\Models\ContactPerson::factory(400)->create();
    }
}
