<?php
namespace Database\Seeders;

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
        Contact::Create([
            'tag_id' => 1,
            'name' => 'Contacto de prueba',
            'image' => 'https://cdn.vuetifyjs.com/images/cards/cooking.png',
            'email' => 'prueba@mail.com',
            'phone_1' => '11 22 33 45',
            'phone_2' => '12 22 33 45',
        ]);
    }
}
