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
                'status' => 'Venta',
            ),
            
            array(
                'status' => 'Alquiler',
            ),       
            array(
                'status' => 'Ventas en lote',
            ),                     
        ];

        foreach ($status as $key => $value) {
            Status::create($value);
        }
    }
}
