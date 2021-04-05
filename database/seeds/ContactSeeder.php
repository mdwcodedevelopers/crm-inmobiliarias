<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->insert([
            'name' => 'usuario',
            'img_path' => '',
            'email' => 'contact@contact.com',
            'tel_1' => '12345678',
            'tel_2' => '12345678'
        ]);
    }
}
