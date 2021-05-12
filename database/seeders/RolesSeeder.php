<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //EUR USD
        $roles = [
            array('name' => 'SuperAdmin'),
            array('name' => 'Cliente'),
            array('name' => 'Agente'),
        ];

        foreach ($roles as $key => $value) {
            Roles::create($value);
        }
    }
}
