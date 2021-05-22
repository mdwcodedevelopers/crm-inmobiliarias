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
        $this->call(RolesSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(GroupTagSeeder::class);
        $this->call(StatusPropertiesSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(StatusOportunitySeeder::class);
        $this->call(CurrencySeeder::class);
        $this->call(EnvironmentSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(SliderHomeSeeder::class);
    }
}
