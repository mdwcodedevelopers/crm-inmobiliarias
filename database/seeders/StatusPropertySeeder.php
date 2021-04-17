<?php

use Illuminate\Database\Seeder;
use App\Status;

class StatusPropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            array( 'name' => 'Alquilar' ),
            array( 'name' => 'En Venta' ),
            array( 'name' => 'En venta con opcion alquiler' ),
            array( 'name' => 'En aquiler con opcion a venta' ),
            array( 'name' => 'Alquiler de tiempo temporal' ),
        ];

        foreach ($status as $key => $value) {
            Status::create($value);
        }
    }
}
