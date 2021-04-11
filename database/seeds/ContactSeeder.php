<?php

use Illuminate\Database\Seeder;
use App\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contacts =
            array(
                'name' => 'Contacto de prueba',
                'img_path' => 'https://cdn.vuetifyjs.com/images/cards/cooking.png',
                'tel_1' => '11 22 33 45',
                'tel_2' => '12 22 33 45',
                'email' => 'prueba@mail.com',
                'tag_id' => 1
            );

        Contact::create($contacts);
    }
}
