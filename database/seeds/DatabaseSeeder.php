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
        $this->call(ContactSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(StatusOportunitySeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(StatusPropertiesSeeder::class);
        $this->call(GroupTagSeeder::class);
    }
}
