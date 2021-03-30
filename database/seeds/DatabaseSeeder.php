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
         $this->call(AdminSeeder::class);
         $this->call(RolesSeeder::class);
>>>>>>> 5339835fbcbc61ff0d4ca2d1e7ded97abfb4db91
    }
}
