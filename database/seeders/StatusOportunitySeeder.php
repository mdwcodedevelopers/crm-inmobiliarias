<?php

namespace Database\Seeders;

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
                'color' => '#607D8B',
            ),
            array(
                'name' => 'Sin seguimiento',
                'color' => '#F9A825',
            ),
            array(
                'name' => 'Pendiente contactar',
                'color' => '#E53935',
            ),
            array(
                'name' => 'Esperando respuesta',
                'color' => '#F4511E',
            ),
            array(
                'name' => 'Evolucionando',
                'color' => '#7CB342',
            ),
            array(
                'name' => 'Tomar acción',
                'color' => '#00ACC1',
            ),
            array(
                'name' => 'Congelado',
                'color' => '#00897B',
            ),

        ];

        foreach ($status as $key => $value) {
            StatusOportunity::create($value);
        }
    }
}
