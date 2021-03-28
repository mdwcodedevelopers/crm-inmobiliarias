<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'SuperAdmin',
            'email' => 'admin@admin.com',
            'password' =>'$2y$10$pP.xaHFwPHfOXDeGMSC17OjtFbdVFizMy.NimwMoGLuQQRb8DQSiq',
            'pronvince' =>'',
            'direction'=>'',
            'phone'=>'',
            'rol_id'=>1
        ]);
    }
}
