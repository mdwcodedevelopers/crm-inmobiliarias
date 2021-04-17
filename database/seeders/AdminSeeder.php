<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
            'role_id'=> 1,
            'name' => 'SuperAdmin',
            'email' => 'admin@admin.com',
            'pronvince' =>'',
            'phone'=>'',
            'direction'=>'',
            'password' => Hash::make('12345678'),
        ]);
    }
}
