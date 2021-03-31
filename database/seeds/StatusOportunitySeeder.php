<?php

use Illuminate\Database\Seeder;
use App\StatusOportunity;

class StatusOportunitySeeder extends Seeder
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
                'name' => 'Sin contactar',
            ),
            array(
                'name' => 'Sin seguimiento',
            ),
            array(
                'name' => 'Pendiente contactar',
            ),
            array(
                'name' => 'Esperando respuesta',
            ),
            array(
                'name' => 'Evolucionando',
            ),
            array(
                'name' => 'Tomar acción',
            ),
            array(
                'name' => 'Congelado',
            ),
                
        ];

        foreach ($status as $key => $value) {
            StatusOportunity::create($value);
        }
    }
}
