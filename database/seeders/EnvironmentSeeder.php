<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Environment;

class EnvironmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enviroments = [
            array( 
                'name' => 'Altillo',
                'type' => '1',
            ),
            array( 
                'name' => 'Baño',
                'type' => '1',
            ),
            array( 
                'name' => 'Balcon', 
                'type' => '1',
            ),
            array( 
                'name' => 'Baulera', 
                'type' => '1',
            ),
            array( 
                'name' => 'Biblioteca', 
                'type' => '1',
            ),
            array( 
                'name' => 'Cocina', 
                'type' => '1',
            ),
            array( 
                'name' => 'Comedor', 
                'type' => '1',
            ),
            array( 
                'name' => 'Comedor diario', 
                'type' => '1',
            ),
            array( 
                'name' => 'Dependencia', 
                'type' => '1',
            ),
            array( 
                'name' => 'Escritorio', 
                'type' => '1',
            ),
            array( 
                'name' => 'Galería', 
                'type' => '1',
            ),
            array( 
                'name' => 'Hall', 
                'type' => '1',
            ),
            array( 
                'name' => 'Jardin', 
                'type' => '1',
            ),
            array( 
                'name' => 'Lavadero',
                'type' => '1',
            ),
            array( 
                'name' => 'Living', 
                'type' => '1',
            ),
            array( 
                'name' => 'Living comedor', 
                'type' => '1',
            ),
            array( 
                'name' => 'Oficina', 
                'type' => '1',
            ),
            array( 
                'name' => 'Patio', 
                'type' => '1',
            ),
            array( 
                'name' => 'Sótano', 
                'type' => '1',
            ),
            array( 
                'name' => 'Suite', 
                'type' => '1',
            ),
            array( 
                'name' => 'Terraza', 
                'type' => '1',
            ),
            array( 
                'name' => 'Vestidor', 
                'type' => '1',
            ),
            array( 
                'name' => 'Aire Acondicionado individual', 
                'type' => '2',
            ),
            array( 
                'name' => 'Alarma',
                'type' => '2',
            ),
            array( 
                'name' => 'Amueblado', 
                'type' => '2',
            ),
            array( 
                'name' => 'Calefacción', 
                'type' => '2',
            ),
            array( 
                'name' => 'Gimnasio',
                'type' => '2',
            ),
            array( 
                'name' => 'Lavadero', 
                'type' => '2',
            ),
            array( 
                'name' => 'Sauna', 
                'type' => '2',
            ),
            array( 
                'name' => 'Seguridad', 
                'type' => '2',
            ),
        ];

        foreach ($enviroments as $key => $value) {
            Environment::create($value);
        }
    }
}
