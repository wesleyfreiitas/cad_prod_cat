<?php

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
        $this->call(PaginationSeeder::class);
        $this->call(ProjectsSeeder::class);
        $this->call(DevelopersSeeder::class);
        $this->call(AlocationsSeeder::class);
    }
}
