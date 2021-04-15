<?php

use Illuminate\Database\Seeder;
use App\Models\GroupTag;

class GroupTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            array(
                'name' => 'Tipo de Cliente',
            ),
            array(
                'name' => 'Origen de contacto',
            ),                
        ];

        foreach ($groups as $key => $value) {
            GroupTag::create($value);
        }
    }
}
