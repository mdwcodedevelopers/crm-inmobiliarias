<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        
        $services = [
            array( 'name' => 'Agua corriente' ),
            array( 'name' => 'Cable' ),
            array( 'name' => 'Cloaca' ),
            array( 'name' => 'Electricidad' ),
            array( 'name' => 'Gas natural' ),
            array( 'name' => 'Internet' ),
            array( 'name' => 'Pavimento' ),
            array( 'name' => 'Telefono' ),
        ];

        foreach ($services as $key => $value) {
            Service::create($value);
        }
    }
}
