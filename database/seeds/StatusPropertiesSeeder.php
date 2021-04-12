<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusPropertiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            array(
                'status' => 'Alquilar',
            ),
            
            array(
                'status' => 'En Venta',
            ),       
            array(
                'status' => 'En venta con opcion alquiler',
            ),
            array(
                'status' => 'En aquiler con opcion a venta',
            ),
            array(
                'status' => 'Alquiler de tiempo temporal',
            ),                     
        ];

        foreach ($status as $key => $value) {
            Status::create($value);
        }
    }
}
