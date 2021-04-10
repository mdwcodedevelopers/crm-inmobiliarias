<?php

use Illuminate\Database\Seeder;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use App\Contact;
>>>>>>> 9936d23f9107233d22b261e78a959e61ca6abfac

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
<<<<<<< HEAD
        DB::table('contacts')->insert([
            'name' => 'usuario',
            'img_path' => '',
            'email' => 'contact@contact.com',
            'tel_1' => '12345678',
            'tel_2' => '12345678'
        ]);
=======
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
>>>>>>> 9936d23f9107233d22b261e78a959e61ca6abfac
    }
}
