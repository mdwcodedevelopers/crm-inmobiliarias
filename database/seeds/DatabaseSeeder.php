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
<<<<<<< HEAD
        // $this->call(UsersTableSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
=======
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(StatusOportunitySeeder::class);
>>>>>>> deee9bd50dbe7da7cbae6768cbe8c1850ae1a9e9
    }
}
