<?php

use Illuminate\Database\Seeder;
use App\Role;

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
            array('name' => 'Usuario'),
            array('name' => 'Agente'),
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
