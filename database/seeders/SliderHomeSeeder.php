<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Slider_home;

class SliderHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slider = [
        array( 
            'image' => '/images/slideBg001.jpg',
            'title' => 'NAKABUCHI ACQUA',
            'subtitle' => 'Conocé una de nuestras mejores inversiones',
        ),
        array( 
            'image' => '/images/slideBg002.jpg',
            'title' => 'PH EN VENTA',
            'subtitle' => 'Interesante inversión con una ubicación ideal',
        ),
        ];
        foreach ($slider as $key => $value) {
            Slider_home::create($value);
        }
    }
}
