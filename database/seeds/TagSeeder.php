<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Tag;

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
            array( 'name' => 'Colega', 'group_tag_id' => 1 ),
            array( 'name' => 'Gremio', 'group_tag_id' => 1 ),
            array( 'name' => 'Inquilino', 'group_tag_id' => 1 ),
            array( 'name' => 'Inversor', 'group_tag_id' => 1 ),
            array( 'name' => 'Propietario', 'group_tag_id' => 1 ),
            array( 'name' => 'Proveedor', 'group_tag_id' => 1 ),
            array( 'name' => 'Argenprop', 'group_tag_id' => 2 ),
            array( 'name' => 'Cartel', 'group_tag_id' => 2 ),
            array( 'name' => 'EnBuenosAires', 'group_tag_id' => 2 ),
            array( 'name' => 'Mercadolibre', 'group_tag_id' => 2 ),
        ];

        foreach ($tags as $key => $value) {
            Tag::create($value);
        }
    }
}
