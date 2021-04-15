<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            array(
                'name' => 'Colega',
                'group_id' => '1',
            ),
            array(
                'name' => 'Gremio',
                'group_id' => '1',
            ),
            array(
                'name' => 'Inquilino',
                'group_id' => '1',
            ),
            array(
                'name' => 'Inversor',
                'group_id' => '1',
            ),
            array(
                'name' => 'Propietario',
                'group_id' => '1',
            ),
            array(
                'name' => 'Proveedor',
                'group_id' => '1',
            ),
            array(
                'name' => 'Argenprop',
                'group_id' => '2',
            ),
            
            array(
                'name' => 'Cartel',
                'group_id' => '2',
            ),
               
            
            array(
                'name' => 'EnBuenosAires',
                'group_id' => '2',
            ),
               
            
            array(
                'name' => 'Mercadolibre',
                'group_id' => '2',
            ),                
        ];

        foreach ($tags as $key => $value) {
            Tag::create($value);
        }
    }
}
