<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'rol' => 'SuperAdmin',
        ]);
        DB::table('roles')->insert([
            'rol' => 'Usuario',
        ]);

        DB::table('roles')->insert([
            'rol' => 'Agente',
        ]);
    }
}
